<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes',
        'read_at',
        'replied_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime'
    ];

    // Scope for new messages
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    // Scope for read messages
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    // Scope for replied messages
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    // Scope for closed messages
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    // Scope for recent messages
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update([
            'status' => 'read',
            'read_at' => now()
        ]);
    }

    // Mark as replied
    public function markAsReplied()
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now()
        ]);
    }

    // Mark as closed
    public function markAsClosed()
    {
        $this->update([
            'status' => 'closed'
        ]);
    }
}