@extends('layouts.site')

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    /*
    |--------------------------------------------------------------------------
    | SEO values
    |--------------------------------------------------------------------------
    */

    $canonicalUrl = $post->canonical_url
        ?: route('post.show', $post->slug);

    $seoTitle = $post->meta_title
        ?: $post->title;

    $seoDescription = $post->meta_description
        ?: ($post->excerpt ?: Str::limit(strip_tags($post->body), 155));

    $featuredImageUrl = $post->featured_image
        ? url(Storage::url($post->featured_image))
        : asset('images/og-default.jpg');

    $schemaType = $post->schema_type
        ?: ($post->type === 'news' ? 'NewsArticle' : 'BlogPosting');

    /*
    |--------------------------------------------------------------------------
    | Author and dates
    |--------------------------------------------------------------------------
    */

    $authorName = optional($post->author)->display_name ?? 'Digital Dost';

    $authorProfileUrl = optional($post->author)->slug
        ? route('author.show', $post->author->slug)
        : url('/');

    $publishedAt = optional($post->published_at)?->toIso8601String();
    $updatedAt = optional($post->updated_at)?->toIso8601String();

    /*
    |--------------------------------------------------------------------------
    | Page UI values
    |--------------------------------------------------------------------------
    */

    $badgeColors = [
        'article' => 'background:#eff6ff;color:#1d4ed8;',
        'review' => 'background:#fffbeb;color:#b45309;',
        'news' => 'background:#fef2f2;color:#b91c1c;',
        'buying_guide' => 'background:#ecfdf5;color:#047857;',
        'tutorial' => 'background:#f5f3ff;color:#6d28d9;',
        'comparison' => 'background:#fdf2f8;color:#be185d;',
    ];

    $readMins = max(
        1,
        round(str_word_count(strip_tags($post->body)) / 200)
    );

    $hasReviewBox = $post->type === 'review'
        && !empty($post->rating);

    $hasProsCons = !empty($post->pros)
        || !empty($post->cons);
@endphp

@section('canonical', $canonicalUrl)

@section('title', $seoTitle . ' — Digital Dost')

@section('meta_description', $seoDescription)

@section('og_type', 'article')
@section('og_title', $seoTitle)
@section('og_description', $seoDescription)
@section('og_image', $featuredImageUrl)
@section('og_image_alt', $post->title)

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', $featuredImageUrl)
@section('twitter_image_alt', $post->title)

@push('head')

{{-- Article Open Graph metadata --}}
@if($publishedAt)
    <meta property="article:published_time" content="{{ $publishedAt }}">
@endif

@if($updatedAt)
    <meta property="article:modified_time" content="{{ $updatedAt }}">
@endif

<meta property="article:author" content="{{ $authorName }}">

@if(optional($post->category)->name)
    <meta property="article:section" content="{{ $post->category->name }}">
@endif

@foreach($post->tags->take(5) as $tag)
    <meta property="article:tag" content="{{ $tag->name }}">
@endforeach

{{-- Article structured data --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => $schemaType,

    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $canonicalUrl,
    ],

    'headline' => $seoTitle,
    'description' => $seoDescription,
    'image' => [
        $featuredImageUrl,
    ],

    'author' => [
        '@type' => 'Person',
        'name' => $authorName,
        'url' => $authorProfileUrl,
    ],

    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Digital Dost',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('images/logo.png'),
        ],
    ],

    'datePublished' => $publishedAt,
    'dateModified' => $updatedAt,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

{{-- Review structured data --}}
@if($post->type === 'review' && !empty($post->rating))
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Review',

    'name' => $seoTitle,
    'headline' => $seoTitle,
    'description' => $seoDescription,

    'url' => $canonicalUrl,

    'author' => [
        '@type' => 'Person',
        'name' => $authorName,
        'url' => $authorProfileUrl,
    ],

    'datePublished' => $publishedAt,

    'reviewRating' => [
        '@type' => 'Rating',
        'ratingValue' => number_format((float) $post->rating, 1, '.', ''),
        'bestRating' => '10',
        'worstRating' => '1',
    ],

    'itemReviewed' => [
        '@type' => 'Product',
        'name' => $post->title,
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

<style>
    .article-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 32px;
    }

    .article-prose {
        font-size: 1.06rem;
        line-height: 1.8;
        color: var(--color-text);
    }

    .article-prose h2 {
        font-family: 'Boska', serif;
        font-size: clamp(1.6rem, 2vw, 2.2rem);
        line-height: 1.15;
        margin: 2.2em 0 .65em;
        scroll-margin-top: 110px;
    }

    .article-prose h3 {
        font-size: 1.22rem;
        font-weight: 800;
        line-height: 1.25;
        margin: 1.7em 0 .65em;
        scroll-margin-top: 110px;
    }

    .article-prose p {
        margin: 0 0 1.2em;
        max-width: 72ch;
    }

    .article-prose a {
        color: var(--color-primary);
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .article-prose ul,
    .article-prose ol {
        margin: 0 0 1.2em 1.2rem;
    }

    .article-prose li {
        margin: 0 0 .5em;
    }

    .article-prose blockquote {
        margin: 1.4em 0;
        padding: 1em 1.2em;
        border-left: 3px solid var(--color-primary);
        background: var(--color-surface);
        border-radius: 0 14px 14px 0;
        color: var(--color-text-muted);
    }

    .article-prose img {
        margin: 1.8em 0;
        border-radius: 18px;
        border: 1px solid var(--color-border);
    }

    .article-prose table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5em 0;
    }

    .article-prose th,
    .article-prose td {
        border: 1px solid var(--color-border);
        padding: .75rem;
        text-align: left;
    }

    .article-prose th {
        background: var(--color-surface-2);
    }

    .toc-link.active {
        color: var(--color-primary);
        font-weight: 800;
    }

    @media (min-width: 1024px) {
        .article-layout {
            grid-template-columns: minmax(0, 1.7fr) 320px;
            align-items: start;
        }
    }
</style>

@endpush

@section('full-width')
<div class="container">
    <nav style="display:flex; gap:8px; flex-wrap:wrap; font-size:.8rem; color:var(--color-text-faint); margin-bottom:18px;">
        <a href="{{ url('/') }}">Home</a>
        <span>/</span>
        @if($post->category)
            <a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a>
            <span>/</span>
        @endif
        <span style="color:var(--color-text-muted);">{{ $post->title }}</span>
    </nav>

    <div class="article-layout">
        <article>
            <span class="eyebrow" style="display:inline-block; padding:7px 10px; border-radius:999px; font-size:.74rem; font-weight:800; {{ $badgeColors[$post->type] ?? 'background:var(--color-surface-2);color:var(--color-text);' }}">
                {{ strtoupper(str_replace('_', ' ', $post->type)) }}
            </span>

            <h1 style="font-family:'Boska', serif; font-size:clamp(2.2rem, 4vw, 4.6rem); line-height:1.02; letter-spacing:-.04em; margin:14px 0 12px;">
                {{ $post->title }}
            </h1>

            @if($post->excerpt)
                <p class="muted" style="font-size:1.1rem; margin:0 0 20px; max-width:60ch;">{{ $post->excerpt }}</p>
            @endif

            <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; padding-bottom:22px; border-bottom:1px solid var(--color-border);">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:42px; height:42px; border-radius:999px; overflow:hidden; background:var(--color-surface-2); display:grid; place-items:center; font-weight:900;">
                        @if(optional($post->author)->avatar)
                            <img src="{{ Storage::url($post->author->avatar) }}" alt="{{ $post->author->name }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            {{ strtoupper(substr(optional($post->author)->display_name ?? 'D', 0, 1)) }}
                        @endif
                    </div>

                    <div>
                        <div style="font-weight:700;">{{ optional($post->author)->display_name ?? 'Digital Dost' }}</div>
                        <div class="muted" style="font-size:.84rem;">{{ optional($post->published_at)?->format('d M Y') }} · {{ $readMins }} min read</div>
                    </div>
                </div>

                <!-- <div style="display:flex; align-items:center; gap:8px;">
                    <a class="btn" target="_blank" rel="noopener noreferrer" href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}">WhatsApp</a>
                    <a class="btn" target="_blank" rel="noopener noreferrer" href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}">X</a>
                    <button type="button" class="btn" onclick="navigator.clipboard.writeText(window.location.href)">Copy</button>
                </div> -->
                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                    <a
                        class="share-btn share-wa"
                        target="_blank"
                        rel="noopener noreferrer"
                        href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                        aria-label="Share on WhatsApp"
                        title="Share on WhatsApp"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="currentColor" d="M20.52 3.48A11.86 11.86 0 0 0 12.07 0C5.52 0 .2 5.32.2 11.87c0 2.09.55 4.13 1.58 5.92L0 24l6.39-1.68a11.84 11.84 0 0 0 5.68 1.45h.01c6.55 0 11.87-5.32 11.87-11.87 0-3.17-1.23-6.16-3.43-8.42ZM12.08 21.76h-.01a9.9 9.9 0 0 1-5.05-1.39l-.36-.21-3.79 1 1.01-3.7-.23-.38a9.88 9.88 0 0 1-1.52-5.22c0-5.46 4.45-9.91 9.92-9.91 2.65 0 5.14 1.03 7.01 2.91a9.85 9.85 0 0 1 2.9 7c0 5.47-4.45 9.92-9.9 9.92Zm5.44-7.4c-.3-.15-1.77-.87-2.04-.97-.27-.1-.46-.15-.66.15-.2.3-.76.97-.94 1.16-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.47-.88-.78-1.48-1.75-1.65-2.05-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.5h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.07c.15.2 2.1 3.2 5.08 4.5.7.3 1.25.49 1.68.63.71.22 1.35.19 1.86.12.57-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35Z"/>
                        </svg>
                    </a>

                    <a
                        class="share-btn share-x"
                        target="_blank"
                        rel="noopener noreferrer"
                        href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                        aria-label="Share on X"
                        title="Share on X"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="currentColor" d="M18.9 2H22l-6.77 7.73L23.2 22h-6.24l-4.9-6.4L6.46 22H3.35l7.24-8.27L.8 2h6.4l4.43 5.86L18.9 2Zm-1.09 18.13h1.72L5.73 3.78H3.88l13.93 16.35Z"/>
                        </svg>
                    </a>

                    <a
                        class="share-btn share-telegram"
                        target="_blank"
                        rel="noopener noreferrer"
                        href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                        aria-label="Share on Telegram"
                        title="Share on Telegram"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="currentColor" d="M9.78 18.65 9.94 14l8.48-7.66c.37-.33-.08-.5-.58-.17L7.36 12.78l-4.52-1.41c-.98-.3-.99-.98.22-1.45L20.73 3.1c.82-.3 1.53.2 1.27 1.45l-3.02 14.22c-.21 1.01-.82 1.26-1.67.78l-4.59-3.38-2.21 2.13c-.25.25-.46.46-.93.35Z"/>
                        </svg>
                    </a>

                    <a
                        class="share-btn share-facebook"
                        target="_blank"
                        rel="noopener noreferrer"
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                        aria-label="Share on Facebook"
                        title="Share on Facebook"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="currentColor" d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07c0 6.03 4.39 11.03 10.13 11.93v-8.44H7.08v-3.49h3.05V9.41c0-3.03 1.79-4.7 4.53-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.95.93-1.95 1.88v2.26h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07Z"/>
                        </svg>
                    </a>

                    <a
                        class="share-btn share-linkedin"
                        target="_blank"
                        rel="noopener noreferrer"
                        href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                        aria-label="Share on LinkedIn"
                        title="Share on LinkedIn"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="currentColor" d="M20.45 20.45H16.9v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.95v5.66H9.36V9h3.4v1.56h.05c.47-.9 1.63-1.85 3.35-1.85 3.58 0 4.24 2.36 4.24 5.43v6.31ZM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12ZM7.12 20.45H3.56V9h3.56v11.45ZM22.23 0H1.77C.8 0 0 .77 0 1.72v20.56C0 23.23.8 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.2 0 22.23 0Z"/>
                        </svg>
                    </a>

                    <button
                        type="button"
                        class="share-btn share-copy"
                        onclick="navigator.clipboard.writeText(window.location.href); this.classList.add('is-copied'); this.setAttribute('aria-label', 'Copied link'); setTimeout(() => this.classList.remove('is-copied'), 1500);"
                        aria-label="Copy link"
                        title="Copy link"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="currentColor" d="M16 1H4a2 2 0 0 0-2 2v12h2V3h12V1Zm3 4H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2Zm0 16H8V7h11v14Z"/>
                        </svg>
                    </button>

                    <button
                        type="button"
                        class="share-btn share-native"
                        onclick="if (navigator.share) { navigator.share({ title: @js($post->title), url: window.location.href }); } else { navigator.clipboard.writeText(window.location.href); }"
                        aria-label="More share options"
                        title="More share options"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="currentColor" d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7a2.5 2.5 0 0 0 0-1.39l7-4.11A2.99 2.99 0 1 0 15 5a2.5 2.5 0 0 0 .04.46l-7 4.11a3 3 0 1 0 0 4.86l7.13 4.18c-.03.14-.05.29-.05.44a3 3 0 1 0 3-2.97Z"/>
                        </svg>
                    </button>
                </div>
            </div>

            @if($post->featured_image)
                <figure style="margin:26px 0 0;">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" style="width:100%; border-radius:24px; border:1px solid var(--color-border);">
                    @if($post->image_caption)
                        <figcaption class="muted" style="margin-top:8px; font-size:.82rem; text-align:center;">{{ $post->image_caption }}</figcaption>
                    @endif
                </figure>
            @endif

            <details class="card mobile-toc" style="margin-top:22px; padding:0; overflow:hidden;">
                <summary style="padding:14px 16px; cursor:pointer; font-weight:800;">Table of Contents</summary>
                <div id="toc-mobile" style="padding:0 16px 16px; display:grid; gap:8px;"></div>
            </details>

            <article id="article-body" class="article-prose" style="margin-top:28px;">
                {!! $post->body !!}
            </article>

            @if(in_array($post->type, ['review', 'buying_guide', 'comparison']))
                <div class="card" style="padding:14px 16px; margin-top:20px; background:var(--color-surface-2);">
                    <p class="muted" style="margin:0; font-size:.9rem;">
                        Disclosure: Some links on this page may be affiliate links, which means we may earn a commission at no extra cost to you.
                    </p>
                </div>
            @endif

            @if($post->tags->count())
                <div style="display:flex; flex-wrap:wrap; gap:8px; margin-top:22px;">
                    @foreach($post->tags as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}" class="btn" style="height:38px;">#{{ $tag->name }}</a>
                    @endforeach
                </div>
            @endif

            <section class="card" style="display:flex; gap:14px; padding:20px; margin-top:24px;">
                <div style="width:56px; height:56px; border-radius:999px; overflow:hidden; background:var(--color-surface-2); display:grid; place-items:center; font-weight:900; flex-shrink:0;">
                    @if(optional($post->author)->avatar)
                        <img src="{{ Storage::url($post->author->avatar) }}" alt="{{ $post->author->display_name }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        {{ strtoupper(substr(optional($post->author)->display_name ?? 'D', 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div style="font-weight:900;">{{ optional($post->author)->display_name ?? 'Digital Dost' }}</div>
                    <p class="muted" style="margin:4px 0 0;">{{ optional($post->author)->bio ?? 'Tech writer covering gadgets, AI, apps and software in simple language.' }}</p>
                </div>
            </section>

            @if(($related ?? collect())->count())
                <section style="margin-top:32px;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:18px;">
                        <h2 class="section-title">Read Next</h2>
                        <div class="divider" style="flex:1;"></div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr; gap:20px;">
                        @foreach($related as $rel)
                            @include('partials.post-card', ['post' => $rel])
                        @endforeach
                    </div>
                </section>
            @endif
        </article>

        <aside style="display:grid; gap:20px; align-self:start;">
            <section class="card desktop-toc" style="padding:20px;">
                <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">Contents</div>
                <nav id="toc-desktop" style="display:grid; gap:10px; margin-top:12px;"></nav>
            </section>

            @include('partials.sidebar')
        </aside>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const article = document.getElementById('article-body');
    const desktopToc = document.getElementById('toc-desktop');
    const mobileToc = document.getElementById('toc-mobile');
    if (!article) return;

    const headings = article.querySelectorAll('h2, h3');
    if (!headings.length) {
        document.querySelector('.desktop-toc')?.remove();
        document.querySelector('.mobile-toc')?.remove();
        return;
    }

    headings.forEach((heading, index) => {
        if (!heading.id) {
            const slug = heading.textContent
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            heading.id = slug || `section-${index + 1}`;
        }

        const klass = heading.tagName === 'H3'
            ? 'padding-left:14px; color:var(--color-text-muted);'
            : 'font-weight:700;';

        const html = `<a href="#${heading.id}" class="toc-link" style="${klass}">${heading.textContent}</a>`;

        if (desktopToc) desktopToc.insertAdjacentHTML('beforeend', html);
        if (mobileToc) mobileToc.insertAdjacentHTML('beforeend', html);
    });

    const links = document.querySelectorAll('.toc-link');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(link => link.classList.remove('active'));
                document.querySelector(`.toc-link[href="#${entry.target.id}"]`)?.classList.add('active');
            }
        });
    }, { rootMargin: '-20% 0px -68% 0px' });

    headings.forEach(h => observer.observe(h));
});
</script>
@endpush