<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'asset_id',
        'name',
        'collection_name',
        'price_eth',
        'token_name',
        'contract_name',
        'contract_address',
        'image_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image(){
        return $this->belongsTo(Image::class);
    }
}
