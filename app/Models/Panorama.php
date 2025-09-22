<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Panorama extends Model
{
    protected $fillable = [
        'name',
        'description', 
        'floor', 
        'display_image', 
        'folder'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the panorama view URL
     */
    public function getViewUrlAttribute(): string
    {
        return route('pano.view', $this);
    }

    /**
     * Get the display image URL
     */
    public function getDisplayImageUrlAttribute(): ?string
    {
        if (!$this->display_image) {
            return null;
        }
        
        return asset('panos/' . $this->folder . '/' . $this->display_image);
    }

    /**
     * Get the panorama folder path
     */
    public function getFolderPathAttribute(): string
    {
        return public_path('panos/' . $this->folder);
    }

    /**
     * Check if panorama files exist
     */
    public function hasValidFiles(): bool
    {
        $mainPath = $this->folder_path . '/index.html';
        $outputPath = $this->folder_path . '/output/index.html';
        
        return file_exists($mainPath) || file_exists($outputPath);
    }

    /**
     * Get the correct subfolder for panorama files
     */
    public function getSubfolderAttribute(): string
    {
        $outputPath = $this->folder_path . '/output/index.html';
        
        if (file_exists($outputPath)) {
            return '/output';
        }
        
        return '';
    }

    /**
     * Scope for active panoramas (with valid files)
     */
    public function scopeActive($query)
    {
        return $query->whereHas('files');
    }

    /**
     * Scope for ordering by creation date
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
