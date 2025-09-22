<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FloorController extends Controller
{
    public function index()
    {
        $floors = Floor::ordered()->get();
        return view('admin.floors.index', compact('floors'));
    }

    public function create()
    {
        return view('admin.floors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/floors'), $imageName);
            $data['image'] = $imageName;
        }

        // Ensure facilities is properly formatted
        if (isset($data['facilities']) && is_array($data['facilities'])) {
            $data['facilities'] = array_filter($data['facilities']); // Remove empty values
        }

        Floor::create($data);

        return redirect()->route('admin.floors.index')->with('success', 'Floor created successfully!');
    }

    public function show(Floor $floor)
    {
        return view('admin.floors.show', compact('floor'));
    }

    public function edit(Floor $floor)
    {
        return view('admin.floors.edit', compact('floor'));
    }

    public function update(Request $request, Floor $floor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($floor->image && file_exists(public_path('images/floors/' . $floor->image))) {
                unlink(public_path('images/floors/' . $floor->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/floors'), $imageName);
            $data['image'] = $imageName;
        }

        // Ensure facilities is properly formatted
        if (isset($data['facilities']) && is_array($data['facilities'])) {
            $data['facilities'] = array_filter($data['facilities']); // Remove empty values
        }

        $floor->update($data);

        return redirect()->route('admin.floors.index')->with('success', 'Floor updated successfully!');
    }

    public function destroy(Floor $floor)
    {
        // Delete image if exists
        if ($floor->image && file_exists(public_path('images/floors/' . $floor->image))) {
            unlink(public_path('images/floors/' . $floor->image));
        }

        $floor->delete();

        return redirect()->route('admin.floors.index')->with('success', 'Floor deleted successfully!');
    }
}