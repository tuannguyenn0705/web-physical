<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'guest_name',
        'guest_email',
        'content',
        'parent_id',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // Bài viết
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // Người bình luận
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Comment cha
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Reply comments
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Scope: đã duyệt
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
