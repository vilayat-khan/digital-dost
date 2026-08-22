<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Redirect extends Model
{
    protected $fillable = [
        'from_path',
        'to_url',
        'status_code',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'status_code' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Redirect $redirect) {
            $redirect->from_path = self::normalizePath($redirect->from_path);
        });

        static::saved(function () {
            Cache::forget('active_redirects');
        });

        static::deleted(function () {
            Cache::forget('active_redirects');
        });
    }

    public static function normalizePath(string $path): string
    {
        $path = '/' . ltrim(trim($path), '/');

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        return $path;
    }
}