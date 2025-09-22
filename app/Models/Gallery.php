<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'alt_text',
        'category',
        'is_featured',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope for active images
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for featured images
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for ordered images
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    // Scope for category
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return asset('images/gallery/' . $this->image_path);
    }
}