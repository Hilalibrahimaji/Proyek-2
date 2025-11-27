<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk pesan belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    // Scope untuk pesan sudah dibaca
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    // Scope untuk pesan sudah dibalas
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    // Accessor untuk format created_at
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y \a\t h:i A');
    }

    // Method untuk menandai sebagai sudah dibaca
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    // Method untuk menandai sebagai sudah dibalas
    public function markAsReplied()
    {
        $this->update(['status' => 'replied']);
    }
}