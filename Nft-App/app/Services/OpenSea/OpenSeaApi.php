<?php

namespace App\Services\OpenSea;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class OpenSeaApi
{
    public function fetch($offset)
    {
        $uri = "https://api.opensea.io/api/v1/assets?owner=0xC352B534e8b987e036A93539Fd6897F53488e56a&order_direction=desc&offset={$offset}&limit=50&collection=cryptopunks";
        try {
            require_once('vendor/autoload.php');
            $client = new Client();
            $response = $client->request('GET', $uri);
            return json_decode($response->getBody(), true);

        } catch (BadRequestException $ex) {
            return $this->error($ex->getMessage());
        }
    }
}
