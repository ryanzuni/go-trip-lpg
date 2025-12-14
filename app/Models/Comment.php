<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'parent_id'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Relationship for parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relationship for child comments (replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Get all approved replies
    public function approvedReplies()
    {
        return $this->replies()->approved();
    }
}
