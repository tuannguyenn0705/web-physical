<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'user_id',
        'status',
        'type',
        'views_count',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    // Danh mục
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Tác giả
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Tags
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    // Bình luận
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Scope: bài đã xuất bản
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }

    // Scope: bài nổi bật
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope: theo loại bài
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    // Tăng lượt xem
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
