@extends('layouts.site')

@section('title', 'Unsubscribed — Digital Dost')
@section('meta_description', 'You have been unsubscribed from the Digital Dost newsletter.')
@section('canonical', url()->current())

@section('full-width')
<div class="container" style="max-width: 720px; padding-block: 48px;">
    <section class="card" style="padding: 24px;">
        <h1 style="margin: 0 0 10px;">You have been unsubscribed</h1>
        <p class="muted" style="margin: 0;">
            {{ $subscriber->email }} will no longer receive newsletter emails from Digital Dost.
        </p>
    </section>
</div>
@endsection