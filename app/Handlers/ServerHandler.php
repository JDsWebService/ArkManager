<?php


namespace App\Handlers;


use App\Models\Ark\ArkOfficialServer;

class ServerHandler
{

    public static function getOfficialServers($array = true)
    {
        if($array) {
            $servers = ArkOfficialServer::orderBy('name', 'asc')->get()->pluck('name', 'id');
        } else {
            $servers = ArkOfficialServer::orderBy('name', 'asc')->get();
        }
        return $servers;
    }
}
