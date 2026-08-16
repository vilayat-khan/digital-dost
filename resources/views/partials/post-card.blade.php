<!-- Post Card Partial -->
@php
    $badgeColors = [
        'article' => 'bg-blue-50 text-blue-700',
        'review' => 'bg-amber-50 text-amber-700',
        'news' => 'bg-red-50 text-red-700',
        'buying_guide' => 'bg-emerald-50 text-emerald-700',
        'tutorial' => 'bg-purple-50 text-purple-700',
        'comparison' => 'bg-pink-50 text-pink-700',
    ];
    $featured = $featured ?? false;
@endphp

@if($featured)
    <a href="{{ route('post.show', $post->slug) }}" class="group grid grid-cols-1 md:grid-cols-2 gap-6 items-center bg-white rounded-2xl border border-[#E7E5DF] overflow-hidden hover:shadow-lg transition-all duration-300">
        <div class="aspect-video md:aspect-auto md:h-full bg-[#F0EEE8] overflow-hidden">
            @if($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @endif
        </div>
        <div class="p-6 md:pr-8">
            <span class="eyebrow inline-block text-[11px] font-semibold px-2 py-1 rounded {{ $badgeColors[$post->type] ?? 'bg-gray-50 text-gray-700' }}">
                [{{ strtoupper(str_replace('_', ' ', $post->type)) }}]
            </span>
            <h2 class="mt-3 text-2xl md:text-3xl font-extrabold leading-tight tracking-tight group-hover:text-[#DC2626] transition-colors">
                {{ $post->title }}
            </h2>
            <div class="mt-4 flex items-center gap-2 text-xs text-[#14151A]/50 font-mono">
                <span>{{ $post->author->name ?? 'Digital Dost' }}</span>
                <span>·</span>
                <span>{{ $post->published_at?->diffForHumans() }}</span>
            </div>
        </div>
    </a>
@else
    <a href="{{ route('post.show', $post->slug) }}" class="group block bg-white rounded-2xl border border-[#E7E5DF] overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
        <div class="aspect-video bg-[#F0EEE8] overflow-hidden">
            @if($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @endif
        </div>
        <div class="p-5">
            <span class="eyebrow inline-block text-[10px] font-semibold px-2 py-1 rounded {{ $badgeColors[$post->type] ?? 'bg-gray-50 text-gray-700' }}">
                [{{ strtoupper(str_replace('_', ' ', $post->type)) }}]
            </span>
            <h3 class="mt-3 font-bold text-[#14151A] leading-snug line-clamp-2 group-hover:text-[#DC2626] transition-colors">
                {{ $post->title }}
            </h3>
            <div class="mt-3 flex items-center gap-2 text-[11px] font-mono text-[#14151A]/45">
                <div class="w-5 h-5 rounded-full bg-[#F0EEE8] flex items-center justify-center text-[9px] font-bold text-[#14151A]/60">
                    {{ strtoupper(substr($post->author->name ?? 'D', 0, 1)) }}
                </div>
                <span>{{ $post->author->name ?? 'Digital Dost' }}</span>
                <span>·</span>
                <span>{{ $post->published_at?->diffForHumans() }}</span>
            </div>
        </div>
    </a>
@endif