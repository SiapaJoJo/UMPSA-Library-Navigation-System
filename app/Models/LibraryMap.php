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

    /**
     * Scope a query to only include active maps.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to get the default map.
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get the full map name with floor and section.
     */
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

    /**
     * Get the embedded URL for iframe.
     */
    public function getEmbedUrlAttribute(): string
    {
        // Convert MappedIn URL to embeddable format
        $url = $this->mappedin_url;
        
        // If it's a directions URL, convert to map URL
        if (strpos($url, '/directions') !== false) {
            $url = str_replace('/directions', '', $url);
        }
        
        // Add embed parameters if not present
        if (strpos($url, '?') !== false) {
            $url .= '&embed=true';
        } else {
            $url .= '?embed=true';
        }
        
        return $url;
    }
}
