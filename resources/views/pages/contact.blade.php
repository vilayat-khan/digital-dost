@extends('layouts.site')

@section('canonical', route('contact'))
@section('title', 'Contact Us — Digital Dost')
@section('meta_description', 'Contact Digital Dost for feedback, corrections, partnerships, press inquiries, or general questions.')

@section('full-width')
<div class="container" style="max-width:860px; padding-block:40px;">
    <section class="card" style="padding:28px;">
        <div class="eyebrow">Contact</div>
        <h1 style="margin:10px 0 8px;">Contact Digital Dost</h1>
        <p class="muted" style="margin:0 0 20px;">
            Questions, feedback, corrections, collaborations, or press inquiries — send us a message below.
        </p>

        @if (session('contact_success'))
            <div style="margin:0 0 16px; padding:12px 14px; border-radius:12px; background:#ecfdf5; color:#166534; border:1px solid #bbf7d0;">
                {{ session('contact_success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" style="display:grid; gap:14px;">
            @csrf

            <div style="display:grid; gap:6px;">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    style="height:46px; border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:0 14px;">
                @error('name')
                    <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid; gap:6px;">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    style="height:46px; border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:0 14px;">
                @error('email')
                    <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid; gap:6px;">
                <label for="subject">Subject</label>
                <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required
                    style="height:46px; border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:0 14px;">
                @error('subject')
                    <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid; gap:6px;">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="7" required
                    style="border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:14px;">{{ old('message') }}</textarea>
                @error('message')
                    <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
                @enderror
            </div>

            <label style="display:flex; gap:10px; align-items:flex-start; font-size:.95rem;">
                <input type="checkbox" name="consent" value="1" {{ old('consent') ? 'checked' : '' }} style="margin-top:4px;">
                <span>I agree to the <a href="{{ route('privacy') }}">Privacy Policy</a> and consent to my message being processed for support and communication purposes.</span>
            </label>

            @error('consent')
                <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </section>
</div>
@endsection