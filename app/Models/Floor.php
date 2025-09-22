<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Floor extends Model
{
    protected $fillable = [
        'name',
        'level',
        'description',
        'image',
        'facilities',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'facilities' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope for active floors
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordered floors
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('level');
    }

    // Accessor for facilities display
    protected function facilitiesList(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_array($this->facilities) ? implode(', ', $this->facilities) : ''
        );
    }
}