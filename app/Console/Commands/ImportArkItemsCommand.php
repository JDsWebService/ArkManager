<?php

namespace App\Console\Commands;

use Exception;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Models\Ark\ArkItemMetaInfo;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;
use App\Exceptions\ArkIDParser\CardException;

class ImportArkItemsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabs Ark Item Information from arkids.net';

    /**
     * Sets the progress bar format
     *
     * @var string
     */
    private $barFormat;

    /**
     * Temporary storage for the source code of the page being scraped
     *
     * @var string
     */
    private $sourceCode;

    /**
     * Storage of all the specific item URLs to then be looped through
     *
     * @var array
     */
    private $itemLinks;

    /**
     * Defines the URI for use in teh Symfony Web Crawler
     *
     * @var string
     */
    private $uri;

    /**
     * Defines a list of loopable page urls for all the other pages of items
     *
     * @var array
     */
    private $pageUrls;

    /**
     * An array of all the item data collected from each link
     *
     * @var array
     */
    private $itemData;
    /**
     * @var object|Crawler
     */

    /**
     * Symfony DOM Crawler Object of the Items Info Card
     *
     * @var mixed
     */
    private $infoCard;
    /**
     * @var string
     */

    /**
     * Defines the current URL of the source code
     *
     * @var string
     */
    private $currentScoureCodeUrl;

    /**
     * Defines the index page of the items list
     *
     * @var string
     */
    private $firstPageUrl;

    /**
     * Defines the Pagination Page Partial URL to be looped
     * through after adding numerical values at the end which
     * defines the specific page number.
     *
     * @var string
     */
    private $paginationPageUrlPartial;

    /**
     * Temporary storage for the item meta data
     *
     * @var array
     */
    private $itemMetaData;

    /**
     * Defines the highest possible page number to search for page URLs
     *
     * @var int Must be equal to or higher then 2
     */
    private $highestPossiblePageNumber;

    /**
     * Allows the skipping of all other page urls and just uses the
     * base url for the data. Good for debugging.
     *
     * @var bool
     */
    private $skipAllOtherPages;

    /**
     * Start time of the command being run
     *
     * @var Carbon
     */
    private $startTime;

    /**
     * Time of completion of the command
     *
     * @var null|Carbon
     */
    private $endTime;

    /**
     * Skip the image download section of the command?
     *
     * @var bool
     */
    private $skipImageDownloads;

    /**
     * File storage path of where to store images using
     * the Laravel Storage Facade.
     *
     * @var string
     */
    private $imageFilePath;

    /**
     * Image placeholder URL
     *
     * @var string
     */
    private $imagePlaceholderUrl;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->barFormat = '[%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %current%/%max% -- %message%';
        $this->uri = 'https://arkids.net';
        $this->itemLinks = [];
        $this->pageUrls = [];
        $this->itemData = [];
        $this->infoCard = null;
        $this->currentScoureCodeUrl = "";
        $this->firstPageUrl = "https://arkids.net/items";
        $this->paginationPageUrlPartial = "https://arkids.net/items/page/";
        $this->itemMetaData = [];
        $this->highestPossiblePageNumber = 100;
        $this->startTime = Carbon::now();
        $this->endTime = null;

        /**
         * User Defined Variables
         */
        $this->imageFilePath = '/public/images/items/icons/';
        $this->imagePlaceholderUrl = 'https://dummyimage.com/120x120/888ea8/ebedf2.png?text=No+Image+Found';
        $this->skipAllOtherPages = false;
        $this->skipImageDownloads = false;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Check the configuration of the command
        try {
            $this->alert("Entering Configuration!");
            $this->checkConfig();
        } catch (Exception $e) {
            $this->alert($e->getMessage());
            return;
        }

        // Generate a list of all possible URLs
        $this->generatePageUrls();

        // Loop through all URLs and grab the Item Links
        $this->getItemLinksFromPageUrls();

        // Loop through all the Item Links and grab the meta data
        $this->getMetaDataInformationFromItemLinks();

        // Download all the images and store them
        $this->storeImageFilesIntoStorage();

        // Store all items in the database
        $this->storeItemsIntoDatabase();

        // Store Meta Data in JSON File
        $this->alert("Storing itemMetaData[] to /public/arkids/items.json file...");
        Storage::put('/public/arkids/items.json', json_encode($this->itemMetaData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $this->endTime = Carbon::now();
        $totalDuration = gmdate('H:i:s', $this->endTime->diffInSeconds($this->startTime));
        $this->line("Start time: {$this->startTime}");
        $this->line("Ending time: {$this->endTime}");
        $this->info("\nCompleted command in: {$totalDuration}");

        return 0;
    }

    /**
     * Generates all possible ArkID's Page URL's up to
     * 100 pages to ensure that the entire list is being
     * downloaded.
     */
    private function generatePageUrls()
    {
        $this->line("Generating Page URL's to loop through...");
        array_push($this->pageUrls, $this->firstPageUrl);
        if($this->skipAllOtherPages == false) {
            for($i = 2; $i <= $this->highestPossiblePageNumber; $i++) {
                $generatedPageUrl = $this->paginationPageUrlPartial . $i;
                array_push($this->pageUrls, $generatedPageUrl);
            }
        }
        $this->info("Generated page URLs successfully!");
    }

    /**
     * Gets the individual item links/URL's by looping through
     * each page URL and then searching for the item link using
     * Symfony's Crawler Package.
     */
    private function getItemLinksFromPageUrls() {
        $this->line("\nGrabbing item links from Page URL's\n");
        foreach($this->pageUrls as $url) {
            $this->line("Working on: {$url}");
            // Get the source code for each url
            if($this->getSourceCode($url) != 200) {
                $this->alert("This url {$url} returned a non-working status code. This must be the last page.");
                // If the status code is not 200 (Working) break out of the loop
                break;
            }
            // Create a new Symfony DOMCrawler and filter to only content in the body tag
            $crawler = new Crawler($this->sourceCode, $this->uri);
            $crawler = $crawler->filter('body');

            // Search Term for Crawler Filter (Each Item Link)
            $results = $crawler->filter('div.cmd-table table#table tbody tr td.ts a');

            // Loop through all search results and add URL's to array.
            $this->line("Searching {$this->currentScoureCodeUrl} source code for item links...");
            $results->each(function (Crawler $node, $i) {
                array_push($this->itemLinks, $node->link()->getUri());
            });
            $this->info("Grabbed all the links from the url {$this->currentScoureCodeUrl}\n");
        }
    }

    /**
     * Gets the source code for a specific URL.
     * Returns the HTTP Request's status code.
     *
     * @param string $url
     * @return int|void
     */
    private function getSourceCode(string $url)
    {
        $this->line('Grabbing Source Code from ' . $url);
        // Create a new Guzzle Client
        $client = new Client();
        try {
            $response = $client->request('GET', $url, ['allow_redirects' => false]);
        } catch (GuzzleException $e) {
            $this->line("\n");
            return $this->alert($e->getMessage());
        }
        if($response->getStatusCode() == 200) {
            $this->sourceCode = $response->getBody()->getContents();
            $this->currentScoureCodeUrl = $url;
            $this->info("Grabbed Source Code Successfully from: {$url}");
        } else {
            $this->alert("The url ({$url}) returned a status code of {$response->getStatusCode()}");
        }
        return $response->getStatusCode();
    }

    /**
     * Loops through all the item links and grabs information
     * from the source code. This method can be expanded upon
     * at a later date to grab information from more then just
     * the information card.
     *
     * @throws CardException
     */
    private function getMetaDataInformationFromItemLinks()
    {
        $this->alert("Visiting each link and extracting item data from source code...");
        $itemLinksCount = count($this->itemLinks);
        $i = 1;
        foreach($this->itemLinks as $url) {
            $this->line("Getting Information for url: {$url}");
            $this->getSourceCode($url);
            $this->getInfoCardForItem($url);
            $this->getMetaDataFromInfoCard();
            // Insert Other Information Grabbing Methods Here.
            $this->info("Completed Item {$i}/{$itemLinksCount}\n");
            $i++;
        }

        $this->info("END - grabMetaDataInformationFromLinks()");
    }

    /**
     * Gets the information card from a specific item page.
     * Assigns the infocard Crawler method to the global
     * infoCard variable.
     *
     * @param string $url
     * @throws CardException
     */
    private function getInfoCardForItem(string $url)
    {
        $this->line("Getting Info Card for the item at url: {$url}");
        // Create a new Symfony DOMCrawler and filter to only
        // content in the body tag and main container.
        $crawler = new Crawler($this->sourceCode, $this->uri);
        $body = $crawler->filter('body');

        // Grab the Columns First Card
        $infoCard = $body
            ->filter('.main-container .row.pad .col-lg-4 .card')
            ->first();
        if($infoCard->html() == "" || $infoCard->html() == null) {
            throw new CardException('Can not find info card');
        }
        $this->info("Successfully found the Info Card for the item at url: {$url}");
        $this->infoCard = $infoCard;
    }

    /**
     * Gets all relevant information from the information card and
     * assigns the value to the global itemMetaData array. This method
     * only grabs information from ONE information card for ONE specific
     * item.
     */
    private function getMetaDataFromInfoCard()
    {
        $metaData = [];
        // Grab the Image URL
        $metaData['name'] = $this->getNameFromInfoCard();
        $this->info("Getting Meta Data Information for: {$metaData['name']}");
        $metaData['image_url'] = $this->uri . $this->getImageFromInfoCard();

        // Store the items into the database by looping through the itemMetaData array
        $metaData['description'] = $this->getDescriptionFromInfoCard();

        $infoCardRows = $this->infoCard->filter('table.table tbody tr');
        $infoCardRows->each(function (Crawler $node, $i) use (&$metaData) {
            $rowName = $node->filter('td')->first()->text();
            $rowData = $node->filter('td')->eq(1);
            switch($rowName) {
                case "Item ID":
                    $this->line("Item ID: {$rowData->text()}");
                    $metaData['item_id'] = $rowData->text();
                    break;
                case "Class Name":
                    $this->line("Class Name: {$rowData->text()}");
                    $metaData['class_name'] = $rowData->text();
                    break;
                case "Type":
                    $this->line("Item Type: {$rowData->text()}");
                    $metaData['type'] = $rowData->text();
                    break;
                case "DLC Item":
                    $metaData['dlc_name'] = null;
                    // Handle DLC Status
                    $metaData['dlc_status'] = $this->getDLCStatusFromInfoCard($rowData);
                    $this->line("DLC Status: {$metaData['dlc_status']}");
                    // If Item is a DLC Item
                    if($metaData['dlc_status'] == "true") {
                        $metaData['dlc_name'] = $this->getDLCNameFromInfoCard($rowData);
                    }
                    $this->line("DLC Name: {$metaData['dlc_name']}");
                    break;
            }
        });
        $this->itemMetaData[$metaData['name']] = $metaData;
    }

    /**
     * Gets the name of the specific item from the information card.
     *
     * @return string|string[]
     */
    private function getNameFromInfoCard()
    {
        return str_replace(" Information", "", $this->infoCard->filter('h3.card-header')->text());
    }

    /**
     * Gets the image url of the specific item from the information card.
     *
     * @return mixed
     */
    private function getImageFromInfoCard()
    {
        return $this->infoCard->filter('div.card-body.text-center img')->attr('src');
    }

    /**
     * Gets the description of the specific item from the information card.
     *
     * @return mixed
     */
    private function getDescriptionFromInfoCard()
    {
        return $this->infoCard->filter('.card-body.no-top p')->first()->text();
    }

    /**
     * Gets the DLC Stats of the specific item from the information card
     *
     * @param $rowData
     * @return string
     */
    private function getDLCStatusFromInfoCard($rowData)
    {
        $statusHtml = $rowData->filter('span');
        $statusClass = $statusHtml->attr('class');
        if(str_contains($statusClass, "badge-warning")) {
            return "false";
        }
        return "true";
    }

    /**
     * Gets the DLC Name of the specific item from the information card
     *
     * @param $rowData
     * @return mixed
     */
    private function getDLCNameFromInfoCard($rowData)
    {
        return $rowData->filter('span')->text();
    }

    /**
     * Checks the setup of the command to ensure all variables
     * at the start of the command are set up correctly.
     *
     * @throws Exception
     */
    private function checkConfig()
    {
        if($this->highestPossiblePageNumber <= 1) {
            throw new Exception("highestPossiblePageNumber is less then or equal to 1. It must be greater then or equal to 2");
        }
        if($this->highestPossiblePageNumber >= 101) {
            throw new Exception("highestPossiblePageNumber is set higher then 101. Theres no way that this setting needs to be this high. Turn it down to less then or equal to 100");
        }
    }

    private function storeImageFilesIntoStorage()
    {
        $path = $this->imageFilePath;
        $extension = '.png';

        if($this->skipImageDownloads == true) {
            $this->alert("skipImageDownloads is set to TRUE. Command will not download images, only meta data");
        } else {
            $this->alert("Storing image files into \"{$path}\" folder with file extension \"{$extension}\"");
        }

        $itemCount = count($this->itemMetaData);
        $i = 1;

        foreach($this->itemMetaData as $item) {
            $this->line("Processing image of: {$item['name']}");
            $skipDownload = false;
            $imageData = [
                'image_public_path' => $this->imagePlaceholderUrl,
                'image_storage_path' => null,
                'image_filename' => null,
                'image_extension' => null,
            ];

            $url = $item['image_url'];
            if($url == null) {
                $this->alert("Dino property image_url is null for {$item['name']}... skipping download.");
                $skipDownload = true;
            }

            if($skipDownload != true) {
                $slug = Str::slug($item['name'] . '-' . $item['item_id']);
                $imageData['image_filename'] = $slug . $extension;
                $imageData['image_storage_path'] = $path . $imageData['image_filename'];
                $imageData['image_public_path'] = str_replace('public', 'storage', $imageData['image_storage_path']);
                $imageData['image_extension'] = $extension;

                $contents = file_get_contents($item['image_url']);

                if($this->skipImageDownloads == false) {
                    if(!Storage::exists($imageData['image_storage_path'])) {
                        Storage::put($imageData['image_storage_path'], $contents);
                        $this->info("Downloaded image {$imageData['image_filename']} successfully!");
                    } else {
                        $this->warn("Image already exists. Skipping download!");
                    }
                }
            }


            foreach($imageData as $key => $value) {
                $this->itemMetaData[$item['name']][$key] = $value;
            }
            $this->info("Completed Image Storage {$i}/{$itemCount}\n");
            $i++;
        }


    }

    private function storeItemsIntoDatabase()
    {
        $this->alert("Storing items into the database");
        $itemCount = count($this->itemMetaData);
        $i = 1;
        foreach($this->itemMetaData as $key => $metaData) {
            $this->line("Processing Item: {$key}");
            $item = ArkItemMetaInfo::where('name', $key)->where('item_id', $metaData['item_id'])->first();
            if($item == null) {
                $item = new ArkItemMetaInfo;
            }
            foreach($metaData as $key => $value) {
                if($key == 'dlc_status') {
                    switch($value) {
                        case "true":
                            $value = true;
                            break;
                        case "false":
                            $value = false;
                            break;
                    }
                }
                $item->{$key} = $value;
            }
            $item->save();
            $this->info("Stored Item \"{$key}\" successfully!");
            $this->info("Completed item {$i}/{$itemCount}\n");
        }
        $this->info("Completed item storage in database");
    }

}


