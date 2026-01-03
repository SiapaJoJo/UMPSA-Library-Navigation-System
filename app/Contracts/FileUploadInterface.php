<?php

namespace App\Contracts;

interface FileUploadInterface
{
    
    public function uploadFile($file, string $directory): string;
    
    
    public function deleteFile(string $filePath): bool;
    
    
    public function getFileUrl(string $filePath): string;
}
