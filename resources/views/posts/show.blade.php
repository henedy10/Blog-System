@extends('posts.layouts.app')

@section('title') {{ $post->title }} @endsection

@section('content')

    @if(session('successUpdatePost'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="rounded-lg bg-green-50 p-4 border border-green-200 shadow-sm flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{session('successUpdatePost')}}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button @click="show = false"
                            class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 transition ease-in-out duration-150">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <a href="{{ route('posts.index') }}"
                class="group inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors">
                <svg class="mr-2 h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to All Posts
            </a>
        </div>

        <article class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <div class="p-8 sm:p-12">
                <header class="mb-10 text-center">
                    <div class="flex items-center justify-center space-x-2 text-sm text-gray-500 mb-4">
                        <span
                            class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 font-medium text-xs tracking-wide uppercase">
                            Article
                        </span>
                        <span class="text-gray-300">&bull;</span>
                        <span class="flex items-center">
                            <svg class="mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{$post->created_at->format('F d, Y')}}
                        </span>
                        <span class="text-gray-300">&bull;</span>
                        @php
                            $colors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'accepted' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{$colors[$post->status]}}">
                            {{$post->status}}
                        </span>
                    </div>

                    <h1
                        class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight leading-tight mb-4">
                        {{$post->title}}
                    </h1>
                </header>

                <div class="prose prose-indigo prose-lg text-gray-600 mx-auto">
                    <p class="whitespace-pre-line leading-relaxed">{{$post->description}}</p>
                </div>

            </div>
        </article>
        @if ($post->status === 'accepted')
            <!-- Mock Comments Section -->
            <div class="mt-12 max-w-3xl mx-auto">

                <div class="flex items-center gap-6 text-sm text-gray-500 mb-6">
                    <span>
                        💬 {{ $post->comments_count }} Comments
                    </span>

                    <span>
                        ❤️ {{ $post->likes_count }} Likes
                    </span>
                </div>

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
        @endif
    </div>
@endsection
