<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use App\Handlers\LogHandler;
use Illuminate\Console\Command;
use App\Models\Ark\ArkDinoMetaInfo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Exception\GuzzleException;
use App\Exceptions\ArkIDParser\CardException;
use Symfony\Component\Console\Helper\ProgressBar;
use App\Exceptions\ArkIDParser\DinoIDNotFoundException;

class ImportArkDinosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:dinos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabs dinos from the ArkIDs Website.';

    /**
     * Sets the progress bar format
     *
     * @var string
     */
    private $barFormat;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->barFormat = '[%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %current%/%max% -- %message%';
    }

    /**
     * Execute the console command.
     *
     * @return int|void
     */
    public function handle() {
        // Grab the Initial URL of the Index Page of ArkID's
        $url = "https://arkids.net/creatures";
        $this->line('Grabbing Source Code from ' . $url);
        // Create a new Guzzle Client
        $client = new Client();
        try {
            $response = $client->request('GET', $url);
        } catch (GuzzleException $e) {
            $this->line("\n");
            return $this->alert($e->getMessage());
        }
        $contents = $response->getBody()->getContents();
        $this->info('Grabbed Source Code Successfully from INDEX');

        // Create a new Symfony DOMCrawler and filter to only content in the body tag
        $uri = 'https://arkids.net';
        $crawler = new Crawler($contents, $uri);
        $crawler = $crawler->filter('body');

        // Search Term for Crawler Filter (Each Dino Link)
        $results = $crawler->filter('td.ts a');

        // Loop through all search results and add URL's to array.
        $this->line("Searching INDEX source code for dino links...");
        $links = $results->each(function (Crawler $node, $i) {
            return $node->link()->getUri();
        });
        $this->info("Grabbed all the links from the INDEX page...");

        // Loop through the links and extract dino date from source code
        $this->line("Visiting each link and extracting dino data from source code...\n");
        $linksBar = $this->createProgressBar(count($links));
        $dinoData = [];
        foreach($links as $url) {
            // Open the link using Guzzle
            try {
                $client = new Client();
                $response = $client->request('GET', $url);
                $contents = $response->getBody()->getContents();
            } catch (GuzzleException $e) {
                $this->line("\n");
                return $this->alert($e->getMessage());
            }

            // Symfony DOMCrawler
            try {
                $crawler = new Crawler($contents, $uri);
                $crawler = $crawler->filter('body');
                $infoCard = $this->getInfoCard($crawler);
                $spawnCard = $this->getSpawnCard($crawler);
            } catch(CardException $e) {
                $this->line("\n");
                return $this->alert($e->getMessage());
            }
            // Grab the name so we can set it in the Progress Bar
            $name = $this->getDinoName($infoCard);
            $linksBar->setMessage("Working on dino: {$name}");
            // Parse all the data
            $image = $this->getDinoImageUrl($infoCard, $uri);
            $description = $this->getDinoDescription($infoCard);
            $nameTag = $this->getDinoNameTag($infoCard);
            $dinoType = $this->getDinoType($infoCard);
            $dlc = $this->getDinoDLCInfo($infoCard);
            $spawnCommand = $this->getDinoSpawnCommand($spawnCard);


            try {
                $dinoID = $this->getDinoID($infoCard);
            } catch(DinoIDNotFoundException $e) {
                $this->line("\n");
                $this->warn('Dino ID Not Found For: ' . $name);
                $dinoID = str_replace(" ", "_", $name) . '_' . 'ID_NOT_FOUND';
                $this->info('DinoID set to default value: ' . $dinoID);
            }

            // Get the image from the URL and store it in the storage folder
            $imageData = $this->storeDinoImageInStorage($image, $dinoID);

            // Grab all of the data and put it into an array
            $dinoData[$name] = [
                'name' => $name,
                'ark_id' => $dinoID,
                'name_tag' => $nameTag,
                'type' => $dinoType,
                'is_dlc' => $dlc['bool'],
                'dlc_name' => $dlc['name'],
                'description' => $description,
                'spawn_command' => $spawnCommand,
                'image_url' => $image,
                'image_public_path' => $imageData['publicPath'],
                'image_storage_path' => $imageData['storagePath'],
                'image_filename' => $imageData['fileName'],
                'image_extension' => $imageData['extension'],
            ];

            // Save into the database
            $this->storeDinoInfoInDatabase($dinoData[$name]);

            $linksBar->advance(1);
        }
        $this->finishProgressBar($linksBar, 'Finished looking at all the dino pages...');

        $this->info("Storing DinoData[] to dinos.json file...\n");
        Storage::put('/public/arkids/dinos.json', json_encode($dinoData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $this->info("Command completed!\n");
        return 0;

    }

    private function getDinoName(\Symfony\Component\DomCrawler\Crawler $infoCard)
    {
        $name = $infoCard->filter('tbody tr:nth-child(1) td:nth-child(2)')->text();
        return str_replace(["(", ")"], "", $name);
    }

    private function getDinoImageUrl(\Symfony\Component\DomCrawler\Crawler $infoCard, string $uri)
    {
        return $uri . $infoCard->filter('.card-body.text-center img')->attr('src');
    }

    private function getDinoDescription(\Symfony\Component\DomCrawler\Crawler $infoCard)
    {
        $description = $infoCard->filter('.card-body.no-top p')->text();
        if($description == null) {
            return null;
        }
        return $description;
    }

    private function getDinoID(\Symfony\Component\DomCrawler\Crawler $infoCard)
    {
        $dinoID = $infoCard->filter('td.ct')->text();
        if($dinoID == null || $dinoID == "") {
            throw new DinoIDNotFoundException('Dino ID was not found...');
        }
        return $dinoID;
    }

    private function getDinoNameTag(\Symfony\Component\DomCrawler\Crawler $infoCard)
    {
        $nameTag = $infoCard->filter('.card-body.no-top table.table.table-hover tbody tr:nth-child(3) td:nth-child(2)')->text();
        if($nameTag == null || $nameTag == "") {
            return null;
        }
        return $nameTag;
    }

    private function getDinoType(\Symfony\Component\DomCrawler\Crawler $infoCard)
    {
        $type = $infoCard->filter('.card-body.no-top table.table.table-hover tbody tr:nth-child(4) td:nth-child(2)')->text();
        if($type == null || $type == "") {
            return null;
        }
        return $type;
    }

    private function getDinoDLCInfo(\Symfony\Component\DomCrawler\Crawler $infoCard)
    {

        $row = $infoCard->filter('.card-body.no-top table.table.table-hover tbody tr:nth-child(5)');

        if($row->filter('td:nth-child(1)')->text() != 'DLC') {
            return ['bool' => null, 'name' => null];
        }

        $dlcTR = $row->filter('td:nth-child(2)');

        try {
            $dlcLink = $dlcTR->filter('a')->attr('href');
            $dlcTag = $dlcTR->filter('span.badge')->text();
        } catch (\InvalidArgumentException $e) {
            return ['bool' => false, 'name' => null];
        }

        return ['bool' => true, 'name' => $dlcTag];
    }

    private function getSpawnCard(\Symfony\Component\DomCrawler\Crawler $crawler)
    {
        $cards = $crawler->filter('.col-lg-8 .card.mb-3')->each(function (Crawler $node, $i) {
            $header = $node->filter('.card-header')->text();
            if(strpos($header, 'Spawn Command') && !strpos($header, 'Advanced')) {
                return $node;
            }
            return;
        });
        $card = array_values(array_filter($cards))[0];
        if($card == null) {
            throw new CardException('SpawnCard not able to be located. Check to see if DOMCrawler filter is picking the right html tag.');
        }
        return $card;
    }

    private function getDinoSpawnCommand(\Symfony\Component\DomCrawler\Crawler $spawnCard)
    {
        return $spawnCard->filter('.card-body .col-lg-8 input[type=text].full-width')->attr('value');
    }

    private function storeDinoImageInStorage($url, string $name)
    {
        if($url == null) {
            $this->warn('Dino Image Not Found For: ' . $name);
            return [
                'storagePath' => null,
                'publicPath' => null,
                'fileName' => null,
                'extension' => null,
            ];
        }

        $path = '/public/images/dinos/icons/';
        $extension = '.png';
        $fileName = $name . $extension;
        $fullPath = $path . $fileName;
        $contents = file_get_contents($url);
        if(!Storage::exists($fullPath)) {
            Storage::put($fullPath, $contents);
        }
        return [
            'storagePath' => $fullPath,
            'publicPath' => str_replace('public', 'storage', $fullPath),
            'fileName' => $fileName,
            'extension' => $extension,
        ];
    }

    private function createProgressBar(int $count, string $msg = "")
    {
        $bar = $this->output->createProgressBar($count);
        $bar->setFormat($this->barFormat);
        $bar->setMessage($msg);
        $bar->start();
        return $bar;
    }

    private function finishProgressBar(ProgressBar $bar, string $string)
    {
        $bar->setMessage($string);
        $bar->finish();
        $this->line('');
    }

    private function getInfoCard(\Symfony\Component\DomCrawler\Crawler $crawler)
    {
        $infoCard = $crawler->filter('.col-lg-4 .card.mb-3');
        $test = $infoCard->filter('.card-header')->text();
        if(strpos($test, 'Information')) {
            return $infoCard;
        }
        throw new CardException('InfoCard not able to be located. Check to see if DOMCrawler filter is picking the right html tag.');
    }

    /**
     * Stores the dino information into the database.
     *
     * @param array $data
     * @return string
     */
    private function storeDinoInfoInDatabase(array $data) {
        $dino = new ArkDinoMetaInfo;
        $dino->name = $data['name'];
        $dino->ark_id = $data['ark_id'];
        $dino->name_tag = $data['name_tag'];
        $dino->type = $data['type'];
        $dino->is_dlc = $data['is_dlc'];
        $dino->dlc_name = $data['dlc_name'];
        $dino->description = $data['description'];
        $dino->spawn_command = $data['spawn_command'];
        $dino->image_url = $data['image_url'];
        $dino->image_public_path = $data['image_public_path'];
        $dino->image_storage_path = $data['image_storage_path'];
        $dino->image_filename = $data['image_filename'];
        $dino->image_extension = $data['image_extension'];
        try {
            $dino->save();
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }
}
