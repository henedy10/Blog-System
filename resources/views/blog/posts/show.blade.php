@extends('blog.layouts.app')

@section('title') {{ $post->title }} @endsection

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <a href="{{ route('blog.index') }}"
                class="group inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors">
                <svg class="mr-2 h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Available Posts
            </a>
        </div>

        <article class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <div class="p-8 sm:p-12">
                <header class="mb-10 text-center">
                    <div class="flex flex-wrap items-center justify-center gap-2 text-sm text-gray-500 mb-4">
                        <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 font-medium text-xs tracking-wide uppercase">
                            Article
                        </span>
                        <span class="text-gray-300">&bull;</span>
                        <span class="flex items-center">
                            {{$post->created_at->format('F d, Y')}}
                        </span>
                        <span class="text-gray-300">&bull;</span>
                        <span class="flex items-center">
                            By <span class="ml-1 font-semibold text-slate-700">{{ $post->user?->name ?? 'Unknown' }}</span>
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight leading-tight mb-4">
                        {{$post->title}}
                    </h1>
                </header>

                <div class="prose prose-indigo prose-lg text-gray-700 mx-auto">
                    <p class="whitespace-pre-line leading-relaxed">{{$post->description}}</p>
                </div>
            </div>
        </article>

        <div class="mt-12 max-w-3xl mx-auto">
            <div class="flex items-center gap-6 text-sm text-gray-500 mb-6">
                <span>
                    💬 {{ $post->comments_count }} Comments
                </span>

                <span>
                    @livewire('like-button' , ['comment' => $post,'status' => 'Post'])
                </span>
            </div>

            <form method="POST" action="{{route('comments.store')}}" class="flex items-start gap-3 mt-4 mb-4">
                @csrf

                <!-- User Avatar -->
                <img
                    src="https://ui-avatars.com/api/?name={{Auth::user()->name[0]}}"
                    class="w-9 h-9 rounded-full"
                >

                <div class="flex-1">
                    <input
                        type="text"
                        id="commentInput"
                        name="comment"
                        placeholder="Write a comment..."
                        class="w-full bg-gray-100 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                    >

                    <input type="hidden" name="post_id" value="{{$post->id}}">

                    <div id="commentButton" class="hidden justify-end mt-2 mb-2 ">
                        <button
                            type="submit"
                            class="px-4 py-1.5 text-sm font-medium text-white bg-blue-500 rounded-full hover:bg-blue-600 transition"
                        >
                            Comment
                        </button>
                    </div>
                </div>
            </form>

            <div class="space-y-6">
                @forelse ($post->comments as $comment)
                    @include('posts.comments.comment',['comment' => $comment , 'post_id' => $post->id])
                @empty
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="bg-gray-50 rounded-full p-4 mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">No comments found</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        const input = document.getElementById('commentInput');
        const button = document.getElementById('commentButton');

        input.addEventListener('input', function () {
            if (this.value.trim().length > 0) {
                button.classList.remove('hidden');
                button.classList.add('flex');
            } else {
                button.classList.add('hidden');
            }
        });
    </script>
@endsection

