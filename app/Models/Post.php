<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $appends = ['featured_image_url'];

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'type',
        'status',
        'featured_image',
        'author_id',
        'category_id',
        'published_at',
        'meta_title',
        'meta_description',
        'canonical_url',
        'schema_type',
        'views_count',
        'reading_time',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'views_count' => 'integer',
            'reading_time' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(AuthorProfile::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }

        // return Storage::url($this->featured_image);

        return url(Storage::url($this->featured_image));
    }

    // public function scopePublished($query)
    // {
    //     return $query->where('status', 'published');
    //         // ->where('published_at', '<=', now());
    // }

    // public function scopePublished($query)
    // {
    //     return $query
    //         ->where('status', 'published')
    //         ->whereNotNull('published_at')
    //         ->where('published_at', '<=', now());
    // }

    // public function getFeaturedImageUrlAttribute(): ?string
    // {
    //     if (!$this->featured_image) {
    //         return null;
    //     }

    //     return Storage::url($this->featured_image);

    //     // return asset('storage/app/public/' . $this->featured_image);
    // }
    
}