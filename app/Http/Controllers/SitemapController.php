<?php

namespace App\Http\Controllers;

use App\Models\AuthorProfile;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    private const CACHE_KEY = 'seo:sitemap.xml:v1';

    public function index()
    {
        $xml = Cache::remember(self::CACHE_KEY, now()->addHour(), function () {
            $urls = [];

            $urls[] = [
                'loc' => url('/'),
                'lastmod' => null,
            ];

            $this->addStaticRoute($urls, 'about');
            $this->addStaticRoute($urls, 'contact');
            $this->addStaticRoute($urls, 'privacy');
            $this->addStaticRoute($urls, 'terms');
            $this->addStaticRoute($urls, 'disclaimer');
            $this->addStaticRoute($urls, 'cookies');
            $this->addStaticRoute($urls, 'affiliate');
            $this->addStaticRoute($urls, 'editorial');

            Category::query()
                ->select('id', 'slug', 'updated_at')
                ->orderBy('id')
                ->get()
                ->each(function (Category $category) use (&$urls) {
                    $urls[] = [
                        'loc' => route('category.show', $category),
                        'lastmod' => $category->updated_at?->toAtomString(),
                    ];
                });

            // Tag::query()
            //     ->select('id', 'slug', 'updated_at')
            //     ->orderBy('id')
            //     ->get()
            //     ->each(function (Tag $tag) use (&$urls) {
            //         $urls[] = [
            //             'loc' => route('tag.show', $tag),
            //             'lastmod' => $tag->updated_at?->toAtomString(),
            //         ];
            //     });

            // AuthorProfile::query()
            //     ->select('id', 'slug', 'updated_at')
            //     ->orderBy('id')
            //     ->get()
            //     ->each(function (AuthorProfile $author) use (&$urls) {
            //         $urls[] = [
            //             'loc' => route('author.show', $author),
            //             'lastmod' => $author->updated_at?->toAtomString(),
            //         ];
            //     });

            Post::query()
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->select('id', 'slug', 'updated_at')
                ->latest('published_at')
                ->get()
                ->each(function (Post $post) use (&$urls) {
                    $urls[] = [
                        'loc' => route('post.show', $post),
                        'lastmod' => $post->updated_at?->toAtomString(),
                    ];
                });

            return $this->toXml($urls);
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    private function addStaticRoute(array &$urls, string $routeName): void
    {
        if (!Route::has($routeName)) {
            return;
        }

        $urls[] = [
            'loc' => route($routeName),
            'lastmod' => null,
        ];
    }

    private function toXml(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($urls as $url) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars($url['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>' . PHP_EOL;

            if (!empty($url['lastmod'])) {
                $xml .= '    <lastmod>' . htmlspecialchars($url['lastmod'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</lastmod>' . PHP_EOL;
            }

            $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return $xml;
    }
}