<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LibraryMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mappedin_url',
        'description',
        'floor',
        'section',
        'is_active',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    
    public function getFullNameAttribute(): string
    {
        $parts = [$this->name];
        
        if ($this->floor) {
            $parts[] = $this->floor;
        }
        
        if ($this->section) {
            $parts[] = $this->section;
        }
        
        return implode(' - ', $parts);
    }

    
    public function getEmbedUrlAttribute(): string
    {

        $url = $this->mappedin_url;

        if (strpos($url, '/directions') !== false) {
            $url = str_replace('/directions', '', $url);
        }

        if (strpos($url, '?') !== false) {
            $url .= '&embed=true';
        } else {
            $url .= '?embed=true';
        }
        
        return $url;
    }
}
