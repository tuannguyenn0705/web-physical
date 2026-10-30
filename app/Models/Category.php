<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Danh mục cha
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Danh mục con
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Bài viết thuộc danh mục
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Scope: chỉ lấy danh mục active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: danh mục gốc (không có parent)
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}
