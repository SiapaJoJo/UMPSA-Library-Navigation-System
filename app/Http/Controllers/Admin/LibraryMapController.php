<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LibraryMap;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LibraryMapController extends Controller
{
    public function index()
    {
        $maps = LibraryMap::ordered()->get();
        return view('admin.maps.index', compact('maps'));
    }

    public function create()
    {
        return view('admin.maps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mappedin_url' => 'required|url',
            'description' => 'nullable|string',
            'floor' => 'nullable|string|max:100',
            'section' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // If this is set as default, unset other defaults
        if ($validated['is_default'] ?? false) {
            LibraryMap::where('is_default', true)->update(['is_default' => false]);
        }

        LibraryMap::create($validated);

        return redirect()->route('admin.maps.index')->with('success', 'Library map created successfully!');
    }

    public function show(LibraryMap $map)
    {
        return view('admin.maps.show', compact('map'));
    }

    public function edit(LibraryMap $map)
    {
        return view('admin.maps.edit', compact('map'));
    }

    public function update(Request $request, LibraryMap $map)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mappedin_url' => 'required|url',
            'description' => 'nullable|string',
            'floor' => 'nullable|string|max:100',
            'section' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // If this is set as default, unset other defaults
        if ($validated['is_default'] ?? false) {
            LibraryMap::where('is_default', true)->where('id', '!=', $map->id)->update(['is_default' => false]);
        }

        $map->update($validated);

        return redirect()->route('admin.maps.index')->with('success', 'Library map updated successfully!');
    }

    public function destroy(LibraryMap $map)
    {
        $map->delete();

        return redirect()->route('admin.maps.index')->with('success', 'Library map deleted successfully!');
    }

    public function setDefault(LibraryMap $map)
    {
        // Unset current default
        LibraryMap::where('is_default', true)->update(['is_default' => false]);
        
        // Set new default
        $map->update(['is_default' => true]);

        return redirect()->route('admin.maps.index')->with('success', 'Default map updated successfully!');
    }
}
