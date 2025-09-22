<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Panorama;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.dashboard');
    }

    public function libraryMap()
    {
        $maps = \App\Models\LibraryMap::active()->ordered()->get();
        $defaultMap = \App\Models\LibraryMap::active()->default()->first();
        
        return view('guest.maps.library-map', compact('maps', 'defaultMap'));
    }


    public function panoramas()
    {
        $panoramas = Panorama::orderBy('created_at', 'desc')->get();
        return view('guest.pano.panoramas', compact('panoramas'));
    }
}
