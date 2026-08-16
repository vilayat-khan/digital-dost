{{-- post-show.blade.php — single article/review page --}}
@extends('layouts.site')

@section('title', $post->title . ' — Digital Dost')
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->content), 155))
@section('og_type', 'article')
@section('og_title', $post->title)
@section('og_image', $post->featured_image ? Storage::url($post->featured_image) : asset('images/og-default.jpg'))

@section('article-content', true) {{-- flag: enables reading progress bar in layout --}}

@section('full-width')

@php
    $badgeColors = [
        'article' => 'bg-blue-50 text-blue-700',
        'review' => 'bg-amber-50 text-amber-700',
        'news' => 'bg-red-50 text-red-700',
        'buying_guide' => 'bg-emerald-50 text-emerald-700',
        'tutorial' => 'bg-purple-50 text-purple-700',
        'comparison' => 'bg-pink-50 text-pink-700',
    ];
    $readMins = max(1, round(str_word_count(strip_tags($post->content)) / 200));
@endphp

{{-- ===== JSON-LD: Article schema (SEO + AdSense trust signal) ===== --}}
@push('head')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "{{ $post->type === 'review' ? 'Review' : 'Article' }}",
    "headline": {!! json_encode($post->title) !!},
    "image": {!! json_encode($post->featured_image ? Storage::url($post->featured_image) : asset('images/og-default.jpg')) !!},
    "datePublished": "{{ $post->published_at?->toIso8601String() }}",
    "dateModified": "{{ $post->updated_at?->toIso8601String() }}",
    "author": { "@type": "Person", "name": {!! json_encode($post->author->name ?? 'Digital Dost') !!} },
    "publisher": { "@type": "Organization", "name": "Digital Dost" }
}
</script>
@endpush

<div class="max-w-6xl mx-auto">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1.5 text-[12px] font-mono text-[#14151A]/40 mb-5">
        <a href="{{ url('/') }}" class="hover:text-[#DC2626]">Home</a>
        <span>/</span>
        <a href="{{ route('category.show', $post->category->slug) }}" class="hover:text-[#DC2626]">{{ $post->category->name }}</a>
        <span>/</span>
        <span class="text-[#14151A]/60 truncate max-w-[200px]">{{ $post->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

        {{-- ===== MAIN COLUMN ===== --}}
        <div class="lg:col-span-8">

            <span class="eyebrow inline-block text-[11px] font-semibold px-2 py-1 rounded {{ $badgeColors[$post->type] ?? 'bg-gray-50 text-gray-700' }}">
                [{{ strtoupper(str_replace('_', ' ', $post->type)) }}]
            </span>

            <h1 class="mt-3 text-3xl md:text-4xl font-extrabold leading-tight tracking-tight">
                {{ $post->title }}
            </h1>

            @if($post->excerpt)
                <p class="mt-3 text-lg text-[#14151A]/60 leading-relaxed">{{ $post->excerpt }}</p>
            @endif

            {{-- Byline / meta row --}}
            <div class="mt-5 flex items-center justify-between flex-wrap gap-3 pb-5 border-b border-[#E7E5DF]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#F0EEE8] flex items-center justify-center font-bold text-sm text-[#14151A]/70 overflow-hidden">
                        @if($post->author->avatar ?? null)
                            <img src="{{ Storage::url($post->author->avatar) }}" class="w-full h-full object-cover" alt="{{ $post->author->name }}">
                        @else
                            {{ strtoupper(substr($post->author->name ?? 'D', 0, 1)) }}
                        @endif
                    </div>
                    <div class="text-sm">
                        <div class="font-semibold">{{ $post->author->name ?? 'Digital Dost' }}</div>
                        <div class="text-[#14151A]/45 font-mono text-[11px]">
                            {{ $post->published_at?->format('d M Y') }} · {{ $readMins }} min read
                        </div>
                    </div>
                </div>

                {{-- Share --}}
                <div class="flex items-center gap-2">
                    <span class="text-[11px] font-mono text-[#14151A]/40 mr-1 hidden sm:inline">SHARE</span>
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" rel="noopener"
                       class="w-8 h-8 rounded-full bg-[#F0EEE8] hover:bg-[#DC2626] hover:text-white flex items-center justify-center transition" aria-label="Share on WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"
                       class="w-8 h-8 rounded-full bg-[#F0EEE8] hover:bg-[#DC2626] hover:text-white flex items-center justify-center transition" aria-label="Share on X">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <button onclick="navigator.clipboard.writeText(window.location.href); this.textContent='✓'"
                       class="w-8 h-8 rounded-full bg-[#F0EEE8] hover:bg-[#DC2626] hover:text-white flex items-center justify-center transition text-xs font-bold" aria-label="Copy link">🔗</button>
                </div>
            </div>

            {{-- Featured image --}}
            @if($post->featured_image)
                <figure class="mt-6">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                         class="w-full rounded-2xl border border-[#E7E5DF]" loading="eager">
                    @if($post->image_caption ?? null)
                        <figcaption class="mt-2 text-[12px] text-center text-[#14151A]/40 font-mono">{{ $post->image_caption }}</figcaption>
                    @endif
                </figure>
            @endif

            {{-- ===== SPEC STRIP (reviews / gadget posts only) ===== --}}
            @if($post->type === 'review' && !empty($post->specs))
                <div class="mt-6 -mx-4 px-4 md:mx-0 md:px-0">
                    <div class="flex gap-3 overflow-x-auto no-scrollbar pb-1">
                        @foreach($post->specs as $label => $value)
                            <div class="shrink-0 bg-[#14151A] text-[#FAFAF8] rounded-xl px-4 py-3 min-w-[130px]">
                                <div class="text-[10px] font-mono text-[#FAFAF8]/50 uppercase tracking-wide">{{ $label }}</div>
                                <div class="text-sm font-bold mt-0.5">{{ $value }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ===== VERDICT BOX (reviews only) ===== --}}
            @if($post->type === 'review' && ($post->rating ?? null))
                <div class="mt-8 bg-[#FAFAF8] border border-[#E7E5DF] rounded-2xl p-6">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// OUR VERDICT</span>
                            <p class="mt-1 text-sm text-[#14151A]/70 max-w-md">{{ $post->verdict_summary ?? Str::limit($post->excerpt, 120) }}</p>
                        </div>
                        <div class="text-center shrink-0">
                            <div class="text-4xl font-extrabold text-[#DC2626]">{{ number_format($post->rating, 1) }}</div>
                            <div class="text-[11px] font-mono text-[#14151A]/40">OUT OF 10</div>
                        </div>
                    </div>

                    @if(!empty($post->pros) || !empty($post->cons))
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5 pt-5 border-t border-[#E7E5DF]">
                            @if(!empty($post->pros))
                                <div>
                                    <h4 class="text-[12px] font-mono font-semibold text-emerald-700 mb-2">PROS</h4>
                                    <ul class="space-y-1.5 text-sm">
                                        @foreach($post->pros as $pro)
                                            <li class="flex gap-2"><span class="text-emerald-600">+</span>{{ $pro }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(!empty($post->cons))
                                <div>
                                    <h4 class="text-[12px] font-mono font-semibold text-red-700 mb-2">CONS</h4>
                                    <ul class="space-y-1.5 text-sm">
                                        @foreach($post->cons as $con)
                                            <li class="flex gap-2"><span class="text-red-600">−</span>{{ $con }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endif

            {{-- Mobile TOC (collapsible) --}}
            @if($post->toc ?? true)
                <details class="lg:hidden mt-6 bg-white border border-[#E7E5DF] rounded-xl">
                    <summary class="px-4 py-3 font-semibold text-sm cursor-pointer">📑 Table of Contents</summary>
                    <div id="toc-mobile" class="px-4 pb-4 text-sm space-y-2"></div>
                </details>
            @endif

            {{-- ===== ARTICLE BODY ===== --}}
            <article id="article-body" class="mt-8 article-prose">
                {!! $post->content !!}
            </article>

            {{-- In-article ad --}}
            <div class="my-10 min-h-[250px] flex items-center justify-center bg-[#F0EEE8] border border-dashed border-[#D8D5CC] rounded-lg text-[11px] font-mono text-[#14151A]/40">
                AD SLOT — in-article native
            </div>

            {{-- Tags --}}
            @if($post->tags->count())
                <div class="flex flex-wrap gap-2 mt-8">
                    @foreach($post->tags as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}"
                           class="text-[12px] font-mono px-3 py-1.5 rounded-full bg-[#F0EEE8] hover:bg-[#DC2626] hover:text-white transition">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Author bio card --}}
            <div class="mt-10 flex gap-4 bg-white border border-[#E7E5DF] rounded-2xl p-5">
                <div class="w-14 h-14 rounded-full bg-[#F0EEE8] flex items-center justify-center font-bold text-lg shrink-0 overflow-hidden">
                    @if($post->author->avatar ?? null)
                        <img src="{{ Storage::url($post->author->avatar) }}" class="w-full h-full object-cover" alt="{{ $post->author->name }}">
                    @else
                        {{ strtoupper(substr($post->author->name ?? 'D', 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div class="font-bold">{{ $post->author->name ?? 'Digital Dost' }}</div>
                    <p class="text-sm text-[#14151A]/60 mt-1 leading-relaxed">{{ $post->author->bio ?? 'Tech writer at Digital Dost, covering gadgets, AI aur software reviews in simple Hinglish.' }}</p>
                </div>
            </div>

            {{-- Comments placeholder --}}
            <div class="mt-10 pt-8 border-t border-[#E7E5DF]">
                <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// DISCUSSION</span>
                <div id="comments" class="mt-4 bg-[#F0EEE8] rounded-xl p-6 text-center text-sm text-[#14151A]/50">
                    Comments jald hi enable honge. Tab tak WhatsApp/Instagram pe apne thoughts share karo.
                </div>
            </div>

            {{-- Related posts --}}
            @if(($related ?? collect())->count())
                <div class="mt-12">
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// READ NEXT</span>
                        <div class="h-px flex-1 bg-[#E7E5DF]"></div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach($related as $rel)
                            @include('partials.post-card', ['post' => $rel])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- ===== SIDEBAR (desktop TOC + widgets) ===== --}}
        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24 self-start hidden lg:block">
            @if($post->toc ?? true)
                <div class="bg-white border border-[#E7E5DF] rounded-2xl p-5">
                    <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// CONTENTS</span>
                    <nav id="toc-desktop" class="mt-3 text-sm space-y-2"></nav>
                </div>
            @endif

            <div class="min-h-[250px] flex items-center justify-center bg-[#F0EEE8] border border-dashed border-[#D8D5CC] rounded-xl text-[11px] font-mono text-[#14151A]/40">
                AD SLOT — 300×250
            </div>

            @include('partials.sidebar')
        </aside>
    </div>
</div>

{{-- Article typography + TOC scroll-spy --}}
@push('head')
<style>
    .article-prose { font-size: 1.0625rem; line-height: 1.75; color:#14151A; }
    .article-prose h2 { font-size:1.5rem; font-weight:800; margin-top:2.2em; margin-bottom:.6em; letter-spacing:-.01em; scroll-margin-top:6rem; }
    .article-prose h3 { font-size:1.2rem; font-weight:700; margin-top:1.8em; margin-bottom:.5em; scroll-margin-top:6rem; }
    .article-prose p { margin-bottom:1.3em; color:#14151A; }
    .article-prose p:first-of-type::first-letter { float:left; font-size:3.4em; line-height:.85; font-weight:800; padding-right:.08em; color:#DC2626; }
    .article-prose a { color:#DC2626; text-decoration:underline; text-underline-offset:2px; }
    .article-prose ul, .article-prose ol { margin:1.2em 0; padding-left:1.4em; }
    .article-prose li { margin-bottom:.5em; }
    .article-prose ul li { list-style:disc; }
    .article-prose ol li { list-style:decimal; }
    .article-prose img { border-radius:1rem; margin:1.8em 0; border:1px solid #E7E5DF; }
    .article-prose blockquote { border-left:3px solid #DC2626; padding-left:1.2em; font-style:italic; color:#14151A99; margin:1.6em 0; }
    .article-prose code { background:#F0EEE8; padding:.15em .4em; border-radius:.3em; font-family:'JetBrains Mono',monospace; font-size:.88em; }
    .article-prose pre { background:#14151A; color:#FAFAF8; padding:1.2em; border-radius:.8em; overflow-x:auto; margin:1.6em 0; }
    .article-prose pre code { background:none; padding:0; color:inherit; }
    .article-prose table { width:100%; border-collapse:collapse; margin:1.6em 0; font-size:.92em; }
    .article-prose th, .article-prose td { border:1px solid #E7E5DF; padding:.6em .8em; text-align:left; }
    .article-prose th { background:#F0EEE8; font-weight:700; }
    .toc-link.active { color:#DC2626; font-weight:600; }
</style>
@endpush

@push('scripts')
<script>
    // Auto-build TOC from article headings
    document.addEventListener('DOMContentLoaded', () => {
        const article = document.getElementById('article-body');
        const desktopToc = document.getElementById('toc-desktop');
        const mobileToc = document.getElementById('toc-mobile');
        if (!article) return;
        const headings = article.querySelectorAll('h2, h3');
        if (!headings.length) { desktopToc?.closest('.bg-white')?.remove(); return; }

        headings.forEach((h, i) => {
            if (!h.id) h.id = 'section-' + i;
            const link = `<a href="#${h.id}" class="toc-link block ${h.tagName === 'H3' ? 'pl-3 text-[#14151A]/60' : 'text-[#14151A]/80'} hover:text-[#DC2626] transition">${h.textContent}</a>`;
            if (desktopToc) desktopToc.insertAdjacentHTML('beforeend', link);
            if (mobileToc) mobileToc.insertAdjacentHTML('beforeend', link);
        });

        const links = document.querySelectorAll('.toc-link');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    links.forEach(l => l.classList.remove('active'));
                    const active = document.querySelector(`.toc-link[href="#${entry.target.id}"]`);
                    active?.classList.add('active');
                }
            });
        }, { rootMargin: '-20% 0px -70% 0px' });
        headings.forEach(h => observer.observe(h));
    });
</script>
@endpush

@endsection