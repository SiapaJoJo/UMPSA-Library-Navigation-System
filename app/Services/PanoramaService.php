<?php

namespace App\Services;

use App\Models\Panorama;
use Illuminate\Http\UploadedFile;
use ZipArchive;

class PanoramaService
{
    /**
     * Create a new panorama
     */
    public function createPanorama(array $data, UploadedFile $panoFile, ?UploadedFile $displayImage = null): Panorama
    {
        $folder = time();
        $path = public_path('panos/' . $folder);
        
        // Create directory
        mkdir($path, 0777, true);
        
        // Extract panorama files
        $this->extractPanoramaFiles($panoFile, $path);
        
        // Handle display image
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
    
    /**
     * Update panorama details
     */
    public function updatePanorama(Panorama $panorama, array $data, ?UploadedFile $displayImage = null): Panorama
    {
        $updateData = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'floor' => $data['floor'] ?? null,
        ];
        
        // Handle display image update
        if ($displayImage) {
            $this->deleteDisplayImage($panorama);
            $updateData['display_image'] = $this->uploadDisplayImage($displayImage, public_path('panos/' . $panorama->folder));
        }
        
        $panorama->update($updateData);
        
        return $panorama;
    }
    
    /**
     * Replace panorama files
     */
    public function replacePanoramaFiles(Panorama $panorama, UploadedFile $panoFile): Panorama
    {
        $path = public_path('panos/' . $panorama->folder);
        
        // Clear old files
        $this->deleteDirectory($path);
        mkdir($path, 0777, true);
        
        // Extract new files
        $this->extractPanoramaFiles($panoFile, $path);
        
        return $panorama;
    }
    
    /**
     * Delete panorama and its files
     */
    public function deletePanorama(Panorama $panorama): bool
    {
        // Delete panorama files
        $this->deleteDirectory(public_path('panos/' . $panorama->folder));
        
        // Delete from storage (legacy cleanup)
        $storagePath = storage_path('app/public/pano2vr/' . $panorama->folder);
        if (file_exists($storagePath)) {
            $this->deleteDirectory($storagePath);
        }
        
        return $panorama->delete();
    }
    
    /**
     * Extract panorama files from ZIP
     */
    private function extractPanoramaFiles(UploadedFile $file, string $path): void
    {
        $zip = new ZipArchive;
        if ($zip->open($file->getRealPath()) !== TRUE) {
            throw new \Exception('Failed to extract ZIP file');
        }
        
        $zip->extractTo($path);
        $zip->close();
    }
    
    /**
     * Upload display image
     */
    private function uploadDisplayImage(UploadedFile $image, string $path): string
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move($path, $imageName);
        return $imageName;
    }
    
    /**
     * Delete display image
     */
    private function deleteDisplayImage(Panorama $panorama): void
    {
        if ($panorama->display_image) {
            $imagePath = public_path('panos/' . $panorama->folder . '/' . $panorama->display_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
    
    /**
     * Delete directory recursively
     */
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
