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

    
    public function getViewUrlAttribute(): string
    {
        return route('pano.view', $this);
    }

    
    public function getDisplayImageUrlAttribute(): ?string
    {
        if (!$this->display_image) {
            return null;
        }
        
        return asset('panos/' . $this->folder . '/' . $this->display_image);
    }

    
    public function getFolderPathAttribute(): string
    {
        return public_path('panos/' . $this->folder);
    }

    
    public function hasValidFiles(): bool
    {
        $mainPath = $this->folder_path . '/index.html';
        $outputPath = $this->folder_path . '/output/index.html';
        
        return file_exists($mainPath) || file_exists($outputPath);
    }

    
    public function getSubfolderAttribute(): string
    {
        $outputPath = $this->folder_path . '/output/index.html';
        
        if (file_exists($outputPath)) {
            return '/output';
        }
        
        return '';
    }

    
    public function scopeActive($query)
    {
        return $query->whereHas('files');
    }

    
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
