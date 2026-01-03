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
    
    
    protected function uploadImage($file, string $directory): string
    {
        return $this->fileUploadService->uploadFile($file, $directory);
    }
    
    
    protected function deleteImage(string $filePath): bool
    {
        return $this->fileUploadService->deleteFile($filePath);
    }
    
    
    protected function getImageUrl(string $filePath): string
    {
        return $this->fileUploadService->getFileUrl($filePath);
    }
}
