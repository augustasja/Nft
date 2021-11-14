<?php

namespace App\Services\OpenSea;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class OpenSeaApi
{
    /**
     * @param $offset
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetch($offset)
    {
        $uri = "https://api.opensea.io/api/v1/assets?asset_contract_address=0xb47e3cd837ddf8e4c57f05d70ab865de6e193bbb&order_direction=asc&offset={$offset}&limit=50";
        try {
            require_once('vendor/autoload.php');

            $client = new Client();
            $response = $client->request('GET', $uri);

            if ($response->getStatusCode() !== 200) {
                return null;
            }

            return json_decode($response->getBody(), true);

        } catch (BadRequestException $ex) {
            return $this->error($ex->getMessage());
        }
    }
}
