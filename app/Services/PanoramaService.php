<?php

namespace App\Services;

use App\Models\Panorama;
use Illuminate\Http\UploadedFile;
use ZipArchive;

class PanoramaService
{
    
    public function createPanorama(array $data, UploadedFile $panoFile, ?UploadedFile $displayImage = null): Panorama
    {
        $folder = time();
        $path = public_path('panos/' . $folder);

        mkdir($path, 0777, true);

        $this->extractPanoramaFiles($panoFile, $path);

        $displayImagePath = null;
        if ($displayImage) {
            $displayImagePath = $this->uploadDisplayImage($displayImage, $path);
        }
        
        return Panorama::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'floor' => $data['floor'] ?? null,
            'display_image' => $displayImagePath,
            'folder' => $folder,
        ]);
    }
    
    
    public function updatePanorama(Panorama $panorama, array $data, ?UploadedFile $displayImage = null): Panorama
    {
        $updateData = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'floor' => $data['floor'] ?? null,
        ];

        if ($displayImage) {
            $this->deleteDisplayImage($panorama);
            $updateData['display_image'] = $this->uploadDisplayImage($displayImage, public_path('panos/' . $panorama->folder));
        }
        
        $panorama->update($updateData);
        
        return $panorama;
    }
    
    
    public function replacePanoramaFiles(Panorama $panorama, UploadedFile $panoFile): Panorama
    {
        $path = public_path('panos/' . $panorama->folder);

        $this->deleteDirectory($path);
        mkdir($path, 0777, true);

        $this->extractPanoramaFiles($panoFile, $path);
        
        return $panorama;
    }
    
    
    public function deletePanorama(Panorama $panorama): bool
    {

        $this->deleteDirectory(public_path('panos/' . $panorama->folder));

        $storagePath = storage_path('app/public/pano2vr/' . $panorama->folder);
        if (file_exists($storagePath)) {
            $this->deleteDirectory($storagePath);
        }
        
        return $panorama->delete();
    }
    
    
    private function extractPanoramaFiles(UploadedFile $file, string $path): void
    {
        $zip = new ZipArchive;
        if ($zip->open($file->getRealPath()) !== TRUE) {
            throw new \Exception('Failed to extract ZIP file');
        }
        
        $zip->extractTo($path);
        $zip->close();
    }
    
    
    private function uploadDisplayImage(UploadedFile $image, string $path): string
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move($path, $imageName);
        return $imageName;
    }
    
    
    private function deleteDisplayImage(Panorama $panorama): void
    {
        if ($panorama->display_image) {
            $imagePath = public_path('panos/' . $panorama->folder . '/' . $panorama->display_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
    
    
    private function deleteDirectory(string $dir): bool
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
