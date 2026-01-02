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

    // Show create form
    public function create()
    {
        return view('admin.pano.create');
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
            
            // Verify extraction - check if index.html exists
            $mainIndex = $path . '/index.html';
            $outputIndex = $path . '/output/index.html';
            
            if (!file_exists($mainIndex) && !file_exists($outputIndex)) {
                // Clean up the folder if extraction failed
                $this->deleteDirectory($path);
                return back()->with('error', 'ZIP extracted but index.html not found. Please ensure your Pano2VR export includes index.html in the root or output folder.');
            }
        } else {
            return back()->with('error', 'Failed to extract ZIP. Please check if the file is a valid ZIP archive.');
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

        return redirect()->route('admin.pano.index')->with('success', 'Panorama added!');
    }

    // Show edit form
    public function edit(Panorama $pano)
    {
        return view('admin.pano.edit', compact('pano'));
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

        return redirect()->route('admin.pano.index')->with('success', 'Panorama updated!');
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
    public function view($pano)
    {
        // Handle route model binding - try to find panorama by ID
        if (is_numeric($pano)) {
            $pano = Panorama::find($pano);
        } elseif (!$pano instanceof Panorama) {
            $pano = Panorama::find($pano);
        }
        
        // Check if panorama exists
        if (!$pano) {
            abort(404, 'Panorama not found. Please check if the panorama exists in the database.');
        }
        
        // Check if folder exists
        $folderPath = public_path('panos/' . $pano->folder);
        if (!file_exists($folderPath) || !is_dir($folderPath)) {
            abort(404, 'Panorama folder not found: ' . $pano->folder . '. Please re-upload the panorama files.');
        }
        
        // Check if index.html exists in the main folder or output folder
        $mainPath = $folderPath . '/index.html';
        $outputPath = $folderPath . '/output/index.html';
        
        // Determine the correct subfolder
        $subfolder = '';
        if (file_exists($outputPath)) {
            $subfolder = '/output';
        } elseif (!file_exists($mainPath)) {
            // List what files are actually in the folder for debugging
            $files = [];
            if (is_dir($folderPath)) {
                $files = array_diff(scandir($folderPath), ['.', '..']);
            }
            $fileList = count($files) > 0 ? implode(', ', array_slice($files, 0, 10)) : 'No files found';
            abort(404, 'Panorama files not found. Expected index.html in ' . $pano->folder . ' or ' . $pano->folder . '/output. Found: ' . $fileList);
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
