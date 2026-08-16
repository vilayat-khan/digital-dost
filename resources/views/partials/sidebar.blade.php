{{-- Sidebar Partial --}}

{{-- Trending --}}
@if(($trendingHot ?? collect())->count())
<div class="bg-white rounded-2xl border border-[#E7E5DF] p-5">
    <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// TRENDING NOW</span>
    <div class="mt-3">
        @foreach($trendingHot as $post)
            <a href="{{ route('post.show', $post->slug) }}" class="flex gap-3 group border-b border-[#E7E5DF] py-3 last:border-0 last:pb-0">
                <div class="w-16 h-16 flex-shrink-0 bg-[#F0EEE8] rounded-lg overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition" alt="{{ $post->title }}">
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-semibold line-clamp-2 group-hover:text-[#DC2626]">{{ $post->title }}</h4>
                    <span class="text-[11px] font-mono text-[#14151A]/40">{{ $post->published_at?->diffForHumans() }}</span>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif

{{-- Most Read --}}
<div class="bg-white rounded-2xl border border-[#E7E5DF] p-5">
    <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// MOST READ</span>
    <div class="mt-3">
        @forelse(($trending ?? collect()) as $i => $post)
            <a href="{{ route('post.show', $post->slug) }}" class="flex gap-3 group border-b border-[#E7E5DF] py-3 last:border-0 last:pb-0">
                <span class="font-mono text-2xl font-extrabold text-[#E7E5DF] leading-none w-6 shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <h4 class="text-sm font-semibold line-clamp-2 group-hover:text-[#DC2626]">{{ $post->title }}</h4>
            </a>
        @empty
            <p class="text-sm text-[#14151A]/50">No trending posts yet.</p>
        @endforelse
    </div>
</div>

{{-- Ad slot: sidebar --}}
<div class="min-h-[250px] flex items-center justify-center bg-[#F0EEE8] border border-dashed border-[#D8D5CC] rounded-xl text-[11px] font-mono text-[#14151A]/40">
    AD SLOT — 300×250
</div>

{{-- Latest Reviews --}}
<div class="bg-white rounded-2xl border border-[#E7E5DF] p-5">
    <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// LATEST REVIEWS</span>
    <div class="mt-3">
        @forelse(($latestReviews ?? collect()) as $post)
            <a href="{{ route('post.show', $post->slug) }}" class="flex items-center justify-between gap-3 group border-b border-[#E7E5DF] py-2.5 last:border-0 last:pb-0">
                <span class="text-sm group-hover:text-[#DC2626] line-clamp-1">{{ $post->title }}</span>
                @if($post->rating ?? null)
                    <span class="text-[11px] font-mono font-bold text-[#DC2626] shrink-0">{{ number_format($post->rating, 1) }}</span>
                @endif
            </a>
        @empty
            <p class="text-sm text-[#14151A]/50">No reviews yet.</p>
        @endforelse
    </div>
</div>

{{-- Newsletter --}}
<div class="bg-[#14151A] text-[#FAFAF8] rounded-2xl p-6 text-center">
    <h3 class="font-bold text-lg">✉️ Stay Updated</h3>
    <p class="text-sm text-[#FAFAF8]/60 mt-1">Get the latest tech news daily</p>
    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-4 flex gap-2">
        @csrf
        <input type="email" name="email" required placeholder="Your email"
               class="flex-1 rounded-full px-4 py-2 text-sm text-[#14151A] border-0 focus:outline-none focus:ring-2 focus:ring-[#DC2626]">
        <button class="bg-[#DC2626] text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-red-700 transition">Go</button>
    </form>
</div>