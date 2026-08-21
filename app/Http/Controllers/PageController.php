<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function disclaimer()
    {
        return view('pages.disclaimer');
    }

    public function cookies()
    {
        return view('pages.cookies');
    }

    public function affiliate()
    {
        return view('pages.affiliate');
    }

    public function editorial()
    {
        return view('pages.editorial');
    }
}