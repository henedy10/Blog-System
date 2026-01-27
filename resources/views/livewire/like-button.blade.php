<div>
    <button
        wire:click='toggleLike'
        class="flex items-center space-x-1 text-gray-400 transition-colors group/comment-like">
        <svg class="h-4 w-4 transform group-hover/comment-like:scale-110 transition-transform {{$isLiked ? 'text-red-500' : 'text-gray-500'}}"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <span class="text-xs {{$isLiked ? 'text-red-500 ' : 'text-gray-500'}}">Like</span>
    </button>
</div>
