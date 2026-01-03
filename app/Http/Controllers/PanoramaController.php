<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panorama;
use ZipArchive;

class PanoramaController extends Controller
{

    public function index()
    {
        $panoramas = Panorama::all();
        return view('admin.pano.index', compact('panoramas'));
    }

    public function create()
    {
        return view('admin.pano.create');
    }

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
        $folder = time();
        $path = public_path('panos/' . $folder);

        mkdir($path, 0777, true);

        $zip = new ZipArchive;
        if ($zip->open($file->getRealPath()) === TRUE) {
            $zip->extractTo($path);
            $zip->close();

            $mainIndex = $path . '/index.html';
            $outputIndex = $path . '/output/index.html';
            
            if (!file_exists($mainIndex) && !file_exists($outputIndex)) {

                $this->deleteDirectory($path);
                return back()->with('error', 'ZIP extracted but index.html not found. Please ensure your Pano2VR export includes index.html in the root or output folder.');
            }
        } else {
            return back()->with('error', 'Failed to extract ZIP. Please check if the file is a valid ZIP archive.');
        }

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

    public function edit(Panorama $pano)
    {
        return view('admin.pano.edit', compact('pano'));
    }

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

        if ($request->hasFile('display_image')) {

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

    public function replace(Request $request, Panorama $pano)
    {
        $request->validate([
            'pano_file' => 'required|mimes:zip|max:500000',
        ]);

        $path = public_path('panos/' . $pano->folder);

        $this->deleteDirectory($path);
        mkdir($path, 0777, true);

        $zip = new ZipArchive;
        if ($zip->open($request->file('pano_file')->getRealPath()) === TRUE) {
            $zip->extractTo($path);
            $zip->close();
        }

        return back()->with('success', 'Panorama files replaced!');
    }

    public function destroy(Panorama $pano)
    {

        $this->deleteDirectory(public_path('panos/' . $pano->folder));

        $storagePath = storage_path('app/public/pano2vr/' . $pano->folder);
        if (file_exists($storagePath)) {
            $this->deleteDirectory($storagePath);
        }
        
        $pano->delete();

        return back()->with('success', 'Panorama deleted!');
    }

    public function view($pano)
    {

        if (is_numeric($pano)) {
            $pano = Panorama::find($pano);
        } elseif (!$pano instanceof Panorama) {
            $pano = Panorama::find($pano);
        }

        if (!$pano) {
            abort(404, 'Panorama not found. Please check if the panorama exists in the database.');
        }

        $folderPath = public_path('panos/' . $pano->folder);
        if (!file_exists($folderPath) || !is_dir($folderPath)) {
            abort(404, 'Panorama folder not found: ' . $pano->folder . '. Please re-upload the panorama files.');
        }

        $mainPath = $folderPath . '/index.html';
        $outputPath = $folderPath . '/output/index.html';

        $subfolder = '';
        if (file_exists($outputPath)) {
            $subfolder = '/output';
        } elseif (!file_exists($mainPath)) {

            $files = [];
            if (is_dir($folderPath)) {
                $files = array_diff(scandir($folderPath), ['.', '..']);
            }
            $fileList = count($files) > 0 ? implode(', ', array_slice($files, 0, 10)) : 'No files found';
            abort(404, 'Panorama files not found. Expected index.html in ' . $pano->folder . ' or ' . $pano->folder . '/output. Found: ' . $fileList);
        }
        
        return view('admin.pano.view', compact('pano', 'subfolder'));
    }

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
