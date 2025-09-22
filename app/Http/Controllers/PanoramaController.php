<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panorama;
use ZipArchive;

class PanoramaController extends Controller
{
    // List panoramas (admin)
    public function index()
    {
        $panoramas = Panorama::all();
        return view('admin.pano.index', compact('panoramas'));
    }

    // Upload new panorama
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'floor' => 'nullable|string|max:100',
            'display_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pano_file' => 'required|mimes:zip|max:500000',
        ]);

        $file = $request->file('pano_file');
        $folder = time(); // unique folder name
        $path = public_path('panos/' . $folder);

        mkdir($path, 0777, true);

        $zip = new ZipArchive;
        if ($zip->open($file->getRealPath()) === TRUE) {
            $zip->extractTo($path);
            $zip->close();
        } else {
            return back()->with('error', 'Failed to extract ZIP.');
        }

        // Handle display image upload
        $displayImagePath = null;
        if ($request->hasFile('display_image')) {
            $displayImage = $request->file('display_image');
            $displayImageName = time() . '_' . $displayImage->getClientOriginalName();
            $displayImage->move(public_path('panos/' . $folder), $displayImageName);
            $displayImagePath = $displayImageName;
        }

        Panorama::create([
            'name' => $request->name,
            'description' => $request->description,
            'floor' => $request->floor,
            'display_image' => $displayImagePath,
            'folder' => $folder,
        ]);

        return back()->with('success', 'Panorama added!');
    }

    // Update panorama details
    public function update(Request $request, Panorama $pano)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'floor' => 'nullable|string|max:100',
            'display_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
            'floor' => $request->floor,
        ];

        // Handle display image upload
        if ($request->hasFile('display_image')) {
            // Delete old display image if exists
            if ($pano->display_image && file_exists(public_path('panos/' . $pano->folder . '/' . $pano->display_image))) {
                unlink(public_path('panos/' . $pano->folder . '/' . $pano->display_image));
            }

            $displayImage = $request->file('display_image');
            $displayImageName = time() . '_' . $displayImage->getClientOriginalName();
            $displayImage->move(public_path('panos/' . $pano->folder), $displayImageName);
            $updateData['display_image'] = $displayImageName;
        }

        $pano->update($updateData);

        return back()->with('success', 'Panorama updated!');
    }

    // Replace panorama files
    public function replace(Request $request, Panorama $pano)
    {
        $request->validate([
            'pano_file' => 'required|mimes:zip|max:500000',
        ]);

        $path = public_path('panos/' . $pano->folder);

        // clear old files
        $this->deleteDirectory($path);
        mkdir($path, 0777, true);

        $zip = new ZipArchive;
        if ($zip->open($request->file('pano_file')->getRealPath()) === TRUE) {
            $zip->extractTo($path);
            $zip->close();
        }

        return back()->with('success', 'Panorama files replaced!');
    }

    // Delete panorama
    public function destroy(Panorama $pano)
    {
        // Delete from public/panos directory
        $this->deleteDirectory(public_path('panos/' . $pano->folder));
        
        // Also delete from storage/app/public/pano2vr directory (legacy cleanup)
        $storagePath = storage_path('app/public/pano2vr/' . $pano->folder);
        if (file_exists($storagePath)) {
            $this->deleteDirectory($storagePath);
        }
        
        $pano->delete();

        return back()->with('success', 'Panorama deleted!');
    }

    // Guest view
    public function view(Panorama $pano)
    {
        // Check if index.html exists in the main folder
        $mainPath = public_path('panos/' . $pano->folder . '/index.html');
        $outputPath = public_path('panos/' . $pano->folder . '/output/index.html');
        
        // Determine the correct subfolder
        $subfolder = '';
        if (file_exists($outputPath)) {
            $subfolder = '/output';
        } elseif (!file_exists($mainPath)) {
            // If neither exists, return 404
            abort(404, 'Panorama files not found');
        }
        
        return view('admin.pano.view', compact('pano', 'subfolder'));
    }

    // Helper to delete directory
    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            $this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item);
        }

        return rmdir($dir);
    }
}
