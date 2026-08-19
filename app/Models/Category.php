<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'icon',
        'meta_title',
        'meta_description',
        'sort_order',
        'show_on_home',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeHeaderItems($query)
    {
        return $query->whereNull('parent_id')
            ->where('show_on_home', 1)
            ->orderBy('sort_order')
            ->orderBy('name');
    }
}