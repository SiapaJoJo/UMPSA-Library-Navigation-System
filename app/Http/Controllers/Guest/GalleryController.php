<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::active()->ordered()->get();
        $categories = Gallery::active()->distinct()->pluck('category')->filter();
        
        return view('guest.galleries.index', compact('galleries', 'categories'));
    }

    public function show(Gallery $gallery)
    {
        if (!$gallery->is_active) {
            abort(404);
        }
        
        return view('guest.galleries.show', compact('gallery'));
    }

    public function category($category)
    {
        $galleries = Gallery::active()->category($category)->ordered()->get();
        $categories = Gallery::active()->distinct()->pluck('category')->filter();
        
        return view('guest.galleries.category', compact('galleries', 'categories', 'category'));
    }
}