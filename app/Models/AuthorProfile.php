<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'display_name',
        'bio',
        'avatar',
        'designation',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'website_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}