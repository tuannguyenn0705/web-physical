<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'affiliate_url',
        'coupon_code',
        'badge_text',
        'sub_badge_text',
        'button_text',
        'is_active',
        'is_featured',
        'order',
        'clicks_count',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'order' => 'integer',
            'clicks_count' => 'integer',
        ];
    }

    /**
     * Scope: chỉ lấy các deal đang hoạt động
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: chỉ lấy các deal nổi bật
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Trả về URL hiển thị hình ảnh logo/thumbnail của Deal
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '/')) {
            return $this->image;
        }

        return Storage::url($this->image);
    }
}
