<?php

namespace App\Console\Commands;

use App\Models\Image;
use App\Services\OpenSea\OpenSeaApi;
use Illuminate\Console\Command;

class FetchApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetches data from API and populates Database';

    /**
     * Create new command instance
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|void
     */
    public function handle()
    {
        try{
            $this->info("Fetching data and seeding database...");
            $offset = 0;
            $api = new OpenSeaApi();

            foreach (range(1, 200) as $i) {
                $body = $api->fetch($offset);
                if($body != null){
                    $this->populate_db($body);
                    $offset += 50;
                }
            }
            return $this->info("Successfully fetched and populated");

        } catch (\Exception $e) {
            return $this->error("There was an error while processing command");
        }
    }

    /**
     * @param $data
     */
    private function populate_db($data)
    {
        foreach ($data as $item) {
            foreach ($item as $prop) {
                $price_eth = 0;
                if ($prop['last_sale'] != null) {
                    $usd_of_eth = round($prop['last_sale']['payment_token']['usd_price'], 2);
                    if ($prop['last_sale']['total_price'] != 0) {
                        $total_price = substr($prop['last_sale']['total_price'], 0, 5);
                        $price_eth = round(($total_price / $usd_of_eth), 3);
                    }
                }
                $asset = [
                    'asset_id' => $prop['id'],
                    'name' => $prop['name'],
                    'collection_name' => $prop['collection']['name'],
                    'price_eth' => $price_eth,
                    'token_name' => $prop['last_sale'] != null ? $prop['last_sale']['payment_token']['name'] : '',
                    'contract_name' => $prop['asset_contract']['name'],
                    'contract_address' => $prop['asset_contract']['address'],
                ];
                $image = [
                    'asset_image' => $prop['image_url'],
                    'token_image' => $prop['last_sale'] != null && $prop['last_sale']['total_price'] != 0
                                                        ? $prop['last_sale']['payment_token']['image_url'] : ''
                ];
                $image_record = Image::Create($image);
                $image_record->asset()->Create($asset);
            }
        }
    }
}
