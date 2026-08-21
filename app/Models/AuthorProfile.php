<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthorProfile extends Model
{
    use HasFactory;

    protected $appends = ['avatar_url'];

    protected $fillable = [
        'user_id',
        'display_name',
        'slug',
        'bio',
        'avatar',
        'designation',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'website_url',
    ];

    protected static function booted(): void
    {
        static::saving(function ($authorProfile) {
            if (empty($authorProfile->slug) && !empty($authorProfile->display_name)) {
                $authorProfile->slug = Str::slug($authorProfile->display_name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    

    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        return Storage::url($this->avatar);
    }
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Storage;

// class AuthorProfile extends Model
// {
//     use HasFactory;

//     protected $appends = ['avatar_url'];

//     protected $fillable = [
//         'user_id',
//         'display_name',
//         'bio',
//         'avatar',
//         'designation',
//         'twitter_url',
//         'linkedin_url',
//         'instagram_url',
//         'website_url',
//     ];

//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     public function getAvatarUrlAttribute(): ?string
//     {
//         if (!$this->avatar) {
//             return null;
//         }

//         return asset('storage/app/public/' . $this->avatar);
//     }

// }