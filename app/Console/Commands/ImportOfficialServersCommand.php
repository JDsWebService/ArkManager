<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Models\Ark\ArkOfficialServer;

class ImportOfficialServersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports a list of official servers from the Battlemetrics API';

    /**
     * The first page of the API Search for official servers using
     * the Battlemetrics API.
     *
     * @var string
     */
    private $baseURL;

    /**
     * Stores all the servers data
     *
     * @var array
     */
    private $servers;

    /**
     * Defines the API page number
     *
     * @var int
     */
    private $page;

    /**
     * Defines the specific server that the command is working on
     *
     * @var int
     */
    private $serverCount;

    /**
     * Defines the total number of servers that were returned from the API
     *
     * @var int
     */
    private $serverTotal;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseURL = "https://api.battlemetrics.com/servers?filter[game]=ark&page[size]=100&filter[features][2e079b9a-d6f7-11e7-8461-83e84cedb373]=true&sort=rank";
        $this->servers = [];
        $this->page = 1;
        $this->serverCount = 1;
        $this->serverTotal = 0;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->alert("Getting all URLs and server data");
        $this->getServersData($this->baseURL);
        $this->serverTotal = count($this->servers);
        $this->alert("Saving servers to the database!");
        foreach($this->servers as $server) {
            $this->line("Working on server {$this->serverCount}/{$this->serverTotal}");
            $server = $server->attributes;
            $arkServer = new ArkOfficialServer;
            $arkServer->battlemetricsID = $server->id;
            $arkServer->steamID = $server->details->serverSteamId;
            $arkServer->name = $server->name;
            $arkServer->ipAddress = $server->ip;
            $arkServer->port = $server->port;
            $arkServer->queryPort = $server->portQuery;
            $arkServer->gameMode = ($server->details->pve == true) ? 'pve' : 'pvp';
            $arkServer->map = $server->details->map;
            $arkServer->day = $server->details->time;
            $arkServer->status = $server->status;
            $arkServer->crossplay = $server->details->crossplay;
            $arkServer->country = $server->country;
            $arkServer->bm_created_at = Carbon::parse($server->createdAt)->format('Y-m-d H:i:s');
            $arkServer->bm_updated_at = Carbon::parse($server->updatedAt)->format('Y-m-d H:i:s');
            $arkServer->save();
            $this->info("{$server->name} has been added to the database successfully!");
            $this->serverCount++;
        }
        $this->info("Command complete!");
        return 0;
    }

    /**
     * Gets all the official servers and puts them into the
     * global servers variable
     *
     * @param string $url
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getServersData(string $url)
    {
        $this->line("Getting page {$this->page} data...");
        $client = new Client();
        $response = $client->request('GET', $url);
        $this->info("Page {$this->page} Status Code: {$response->getStatusCode()}");
        $contents = json_decode($response->getBody()->getContents());
        foreach($contents->data as $server) {
            array_push($this->servers, $server);
        }
        $links = $contents->links;
        if(isset($links->next)) {
            $this->page++;
            $this->getServersData($links->next);
        }
    }
}
