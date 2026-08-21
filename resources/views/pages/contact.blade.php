@extends('layouts.site')

@section('canonical', route('contact'))
@section('title', 'Contact Us — Digital Dost')
@section('meta_description', 'Contact Digital Dost for feedback, corrections, partnerships, press inquiries, or general questions.')

@section('full-width')
<section class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
    <div class="grid gap-8 lg:grid-cols-[1fr_380px] lg:items-start">
        <div class="rounded-[28px] border border-neutral-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="mb-6">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-red-600">Contact</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-neutral-950 sm:text-4xl">
                    Contact Digital Dost
                </h1>
                <p class="mt-3 max-w-2xl text-[15px] leading-7 text-neutral-600 sm:text-base">
                    Questions, feedback, corrections, partnerships, or press inquiries — send us a message and we will get back to you.
                </p>
            </div>

            @if (session('contact_success'))
                <div
                    role="status"
                    aria-live="polite"
                    class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800"
                >
                    {{ session('contact_success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-neutral-900">
                            Name <span class="text-red-600">*</span>
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            aria-required="true"
                            aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                            class="h-12 w-full rounded-2xl border border-neutral-300 bg-white px-4 text-[16px] text-neutral-900 placeholder:text-neutral-400 focus:border-red-500 focus:outline-none focus:ring-4 focus:ring-red-100"
                            placeholder="Your full name"
                        >
                        @error('name')
                            <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-neutral-900">
                            Email <span class="text-red-600">*</span>
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            aria-required="true"
                            aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                            class="h-12 w-full rounded-2xl border border-neutral-300 bg-white px-4 text-[16px] text-neutral-900 placeholder:text-neutral-400 focus:border-red-500 focus:outline-none focus:ring-4 focus:ring-red-100"
                            placeholder="you@example.com"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="subject" class="mb-2 block text-sm font-semibold text-neutral-900">
                        Subject <span class="text-red-600">*</span>
                    </label>
                    <input
                        id="subject"
                        name="subject"
                        type="text"
                        value="{{ old('subject') }}"
                        required
                        aria-required="true"
                        aria-invalid="{{ $errors->has('subject') ? 'true' : 'false' }}"
                        class="h-12 w-full rounded-2xl border border-neutral-300 bg-white px-4 text-[16px] text-neutral-900 placeholder:text-neutral-400 focus:border-red-500 focus:outline-none focus:ring-4 focus:ring-red-100"
                        placeholder="What would you like to discuss?"
                    >
                    @error('subject')
                        <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="mb-2 block text-sm font-semibold text-neutral-900">
                        Message <span class="text-red-600">*</span>
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="7"
                        required
                        aria-required="true"
                        aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}"
                        class="w-full rounded-2xl border border-neutral-300 bg-white px-4 py-3 text-[16px] leading-7 text-neutral-900 placeholder:text-neutral-400 focus:border-red-500 focus:outline-none focus:ring-4 focus:ring-red-100"
                        placeholder="Write your message here..."
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-2xl border border-neutral-200 bg-neutral-50 p-4">
                    <label for="consent" class="flex cursor-pointer items-start gap-3">
                        <input
                            id="consent"
                            name="consent"
                            type="checkbox"
                            value="1"
                            {{ old('consent') ? 'checked' : '' }}
                            class="mt-1 h-4 w-4 rounded border-neutral-300 text-red-600 focus:ring-red-500"
                        >
                        <span class="text-sm leading-6 text-neutral-700">
                            I agree to the
                            <a href="{{ route('privacy') }}" class="font-semibold text-red-600 underline underline-offset-4 hover:text-red-700">
                                Privacy Policy
                            </a>
                            and consent to my message being processed for support and communication purposes.
                        </span>
                    </label>
                    @error('consent')
                        <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-neutral-500">
                        We usually reply within 2–3 business days.
                    </p>

                    <button
                        type="submit"
                        class="inline-flex min-h-[48px] items-center justify-center rounded-full bg-red-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-200"
                    >
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        <aside class="space-y-5">
            <div class="rounded-[28px] border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-red-600">Reach us</p>
                <h2 class="mt-3 text-xl font-black text-neutral-950">Other ways to connect</h2>
                <div class="mt-5 space-y-4 text-sm leading-6 text-neutral-700">
                    <div>
                        <p class="font-semibold text-neutral-900">Email</p>
                        <p>hello@digitaldost.com</p>
                    </div>
                    <div>
                        <p class="font-semibold text-neutral-900">Topics</p>
                        <p>Feedback, corrections, partnerships, press, reviews, and general questions.</p>
                    </div>
                    <div>
                        <p class="font-semibold text-neutral-900">Response time</p>
                        <p>Usually within 2–3 business days.</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[28px] border border-neutral-200 bg-neutral-950 p-6 text-white shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-red-400">Note</p>
                <h2 class="mt-3 text-xl font-black">Before you send</h2>
                <ul class="mt-4 space-y-3 text-sm leading-6 text-neutral-300">
                    <li>Share the article URL if your message is about a correction.</li>
                    <li>Add brand or product names clearly for review-related queries.</li>
                    <li>Use the same email you want us to reply to.</li>
                </ul>
            </div>
        </aside>
    </div>
</section>
@endsection