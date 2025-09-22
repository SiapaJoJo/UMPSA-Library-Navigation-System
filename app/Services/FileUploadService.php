<?php

namespace App\Services;

use App\Contracts\FileUploadInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService implements FileUploadInterface
{
    /**
     * Upload a file and return the file path
     */
    public function uploadFile($file, string $directory): string
    {
        if (!$file instanceof UploadedFile) {
            throw new \InvalidArgumentException('File must be an instance of UploadedFile');
        }
        
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($directory), $fileName);
        
        return $fileName;
    }
    
    /**
     * Delete a file
     */
    public function deleteFile(string $filePath): bool
    {
        $fullPath = public_path($filePath);
        
        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }
        
        return false;
    }
    
    /**
     * Get the full URL for a file
     */
    public function getFileUrl(string $filePath): string
    {
        return asset($filePath);
    }
}
