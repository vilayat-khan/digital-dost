<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        if ($request->filled('website')) {
            return back()->with('newsletter_error', 'Something went wrong. Please try again.');
        }

        $validated = $request->validate([
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'consent' => ['accepted'],
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'consent.accepted' => 'Please confirm that you want to receive newsletter emails.',
        ]);

        $emailDomain = Str::lower(Str::after($validated['email'], '@'));

        $disposableDomains = [
            'mailinator.com',
            'tempmail.com',
            'throwaway.email',
        ];

        if (in_array($emailDomain, $disposableDomains, true)) {
            return back()
                ->withInput()
                ->with('newsletter_error', 'Please use a permanent email address.');
        }

        // Example:
        // Save subscriber as pending OR send to your email service with double opt-in.
        // NewsletterSubscriber::firstOrCreate(
        //     ['email' => $validated['email']],
        //     ['status' => 'pending', 'consented_at' => now()]
        // );

        return back()->with('newsletter_success', 'Thanks for subscribing. Please check your inbox to confirm your subscription.');
    }
}