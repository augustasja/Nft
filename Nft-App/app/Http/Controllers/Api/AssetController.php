<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $response){
        try {
            return Asset::with('image')->get();

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }
}
