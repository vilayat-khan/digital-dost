<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class HandleRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! in_array($request->method(), ['GET', 'HEAD'])) {
            return $next($request);
        }

        $path = Redirect::normalizePath('/' . ltrim($request->decodedPath(), '/'));

        $redirects = Cache::rememberForever('active_redirects', function () {
            return Redirect::query()
                ->where('is_active', true)
                ->get(['from_path', 'to_url', 'status_code']);
        });

        $match = $redirects->first(function ($redirect) use ($path) {
            return $redirect->from_path === $path;
        });

        if (! $match) {
            return $next($request);
        }

        if ((int) $match->status_code === 410) {
            abort(410);
        }

        return redirect($match->to_url, (int) $match->status_code);
    }
}