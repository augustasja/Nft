<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * @param Request $request
     * @return mixed|string
     */
    public function index(Request $request)
    {
        try {
            $page = $_GET['page'];
            $search = $_GET['search'];

            $assets = cache()->remember("assets-{$page}-{$search}", 60, function () {
                return Asset::when(\request('search'), function ($query) {
                    $query->where('name', 'like', '%' . \request('search') . '%');
                })->with('image')->paginate(50);
            });

            return $assets;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
