<div>
    <button
        class="hover:text-indigo-600 transition"
        @click="repliesOpen = !repliesOpen"
        wire:click='loadReplies'
    >
        {{ $comment->replies_count }}
        {{ Str::plural('reply', $comment->replies_count) }}
    </button>
</div>
