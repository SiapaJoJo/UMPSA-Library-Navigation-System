<?php

namespace App\Contracts;

interface FileUploadInterface
{
    /**
     * Upload a file and return the file path
     */
    public function uploadFile($file, string $directory): string;
    
    /**
     * Delete a file
     */
    public function deleteFile(string $filePath): bool;
    
    /**
     * Get the full URL for a file
     */
    public function getFileUrl(string $filePath): string;
}
