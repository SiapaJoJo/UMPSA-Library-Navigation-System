<?php

namespace App\Traits;

use App\Services\FileUploadService;

trait HandlesFileUploads
{
    protected FileUploadService $fileUploadService;
    
    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }
    
    /**
     * Upload an image file
     */
    protected function uploadImage($file, string $directory): string
    {
        return $this->fileUploadService->uploadFile($file, $directory);
    }
    
    /**
     * Delete an image file
     */
    protected function deleteImage(string $filePath): bool
    {
        return $this->fileUploadService->deleteFile($filePath);
    }
    
    /**
     * Get image URL
     */
    protected function getImageUrl(string $filePath): string
    {
        return $this->fileUploadService->getFileUrl($filePath);
    }
}
