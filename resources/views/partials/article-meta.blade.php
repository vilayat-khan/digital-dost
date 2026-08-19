@php
    $readMins = max(1, round(str_word_count(strip_tags($post->content)) / 200));
@endphp

<div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; padding-bottom:22px; border-bottom:1px solid var(--color-border);">
    <div style="display:flex; align-items:center; gap:12px;">
        <div style="width:42px; height:42px; border-radius:999px; overflow:hidden; background:var(--color-surface-2); display:grid; place-items:center; font-weight:900;">
            @if(optional($post->author)->avatar)
                <img src="{{ Storage::url($post->author->avatar) }}" alt="{{ $post->author->name }}" style="width:100%; height:100%; object-fit:cover;">
            @else
                {{ strtoupper(substr(optional($post->author)->name ?? 'D', 0, 1)) }}
            @endif
        </div>

        <div>
            <div style="font-weight:700;">{{ optional($post->author)->name ?? 'Digital Dost' }}</div>
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