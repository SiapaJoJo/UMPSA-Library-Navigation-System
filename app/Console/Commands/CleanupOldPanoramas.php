<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Panorama;

class CleanupOldPanoramas extends Command
{
    protected $signature = 'panorama:cleanup';
    protected $description = 'Clean up old panorama files from storage/app/public/pano2vr/';

    public function handle()
    {
        $this->info('Starting cleanup of old panorama files...');
        
        $storagePath = storage_path('app/public/pano2vr');
        
        if (!file_exists($storagePath)) {
            $this->info('No storage directory found. Nothing to clean up.');
            return;
        }
        
        // Get all panorama folders from database
        $panoramas = Panorama::pluck('folder')->toArray();
        
        // Get all folders in storage
        $storageFolders = array_diff(scandir($storagePath), ['.', '..']);
        
        $deletedCount = 0;
        
        foreach ($storageFolders as $folder) {
            if (is_dir($storagePath . '/' . $folder)) {
                // Check if this folder is not in the database (orphaned)
                if (!in_array($folder, $panoramas)) {
                    $this->info("Deleting orphaned folder: {$folder}");
                    $this->deleteDirectory($storagePath . '/' . $folder);
                    $deletedCount++;
                } else {
                    $this->info("Keeping active panorama folder: {$folder}");
                }
            }
        }
        
        $this->info("Cleanup completed! Deleted {$deletedCount} orphaned folders.");
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