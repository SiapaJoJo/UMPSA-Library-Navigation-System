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
        $panoramas = Panorama::all()->sortBy(function($panorama) {
            $floor = strtolower($panorama->floor ?? '');
            $order = [
                'ground floor' => 1,
                '1st floor' => 2,
                'first floor' => 2,
                '2nd floor' => 3,
                'second floor' => 3,
                '3rd floor' => 4,
                'third floor' => 4,
            ];
            return $order[$floor] ?? 999;
        });
        return view('guest.pano.panoramas', compact('panoramas'));
    }
}
