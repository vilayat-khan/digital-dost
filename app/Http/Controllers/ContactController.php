<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
            'consent' => ['accepted'],
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please enter a subject.',
            'message.required' => 'Please enter your message.',
            'consent.accepted' => 'Please accept the privacy policy before sending your message.',
        ]);

        Mail::to(config('mail.from.address'))->send(new ContactMessageMail($validated));

        Log::info('Contact form submitted', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'ip' => $request->ip(),
        ]);

        return back()->with('contact_success', 'Thanks for contacting us. We have received your message.');
    }
}