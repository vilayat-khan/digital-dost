<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterWelcomeMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        $subscriber = NewsletterSubscriber::where('email', $validated['email'])->first();

        if ($subscriber) {
            if ($subscriber->status === 'subscribed') {
                return back()->with('newsletter_success', 'You are already subscribed.');
            }

            $subscriber->update([
                'status' => 'subscribed',
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
                'unsubscribe_token' => $subscriber->unsubscribe_token ?: Str::random(64),
            ]);

            Mail::to($subscriber->email)->send(new NewsletterWelcomeMail($subscriber));

            Log::info('Newsletter resubscription', ['email' => $subscriber->email]);

            return back()->with('newsletter_success', 'Welcome back. You are subscribed again.');
        }

        $subscriber = NewsletterSubscriber::create([
            'email' => $validated['email'],
            'status' => 'subscribed',
            'subscribed_at' => now(),
            'unsubscribe_token' => Str::random(64),
        ]);

        Mail::to($subscriber->email)->send(new NewsletterWelcomeMail($subscriber));

        Log::info('Newsletter subscription', ['email' => $subscriber->email]);

        return back()->with('newsletter_success', 'Thanks for subscribing.');
    }

    public function unsubscribe(string $token)
    {
        $subscriber = NewsletterSubscriber::where('unsubscribe_token', $token)->firstOrFail();

        $subscriber->update([
            'status' => 'unsubscribed',
            'unsubscribed_at' => now(),
        ]);

        Log::info('Newsletter unsubscribe', ['email' => $subscriber->email]);

        return view('newsletter-unsubscribed', compact('subscriber'));
    }
}