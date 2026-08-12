<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

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
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'views_count' => 'integer',
            'reading_time' => 'integer',
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function authorProfile()
    {
        return $this->hasOneThrough(
            AuthorProfile::class,
            User::class,
            'id',        // FK on users table
            'user_id',    // FK on author_profiles table
            'author_id',  // local key on posts table
            'id'          // local key on users table
        );
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
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }
}