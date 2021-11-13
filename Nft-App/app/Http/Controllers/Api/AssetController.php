<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        try {
            return Asset::when(\request('search'), function ($query) {
                $query->where('name', 'like', '%' . \request('search') . '%');
            })->with('image')->orderBy('id', 'desc')->paginate(50);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }
}
