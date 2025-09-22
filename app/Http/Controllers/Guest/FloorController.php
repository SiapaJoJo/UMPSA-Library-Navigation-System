<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Floor;

class FloorController extends Controller
{
    public function index()
    {
        $floors = Floor::active()->ordered()->get();
        return view('guest.floors.index', compact('floors'));
    }

    public function show(Floor $floor)
    {
        if (!$floor->is_active) {
            abort(404);
        }
        
        return view('guest.floors.show', compact('floor'));
    }
}