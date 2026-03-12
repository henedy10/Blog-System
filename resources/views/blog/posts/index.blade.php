@extends('blog.layouts.app')

@section('title') Available Posts @endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Available Posts</h1>
                <p class="mt-2 text-slate-600">Read the latest accepted posts.</p>
            </div>

            <form method="GET" action="{{ route('blog.index') }}" class="w-full sm:w-96">
                <label class="sr-only" for="q">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input id="q" name="q" value="{{ $q }}" type="text"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out shadow-sm"
                        placeholder="Search posts by title...">
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($posts as $post)
                <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full border border-gray-100 group">
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <span class="flex items-center text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">
                                {{$post->created_at->format('M d, Y')}}
                            </span>
                            {{-- <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                accepted
                            </span> --}}
                        </div>

                        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                            <a href="{{ route('blog.show', $post->slug) }}">
                                {{$post->title}}
                            </a>
                        </h2>

                        <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($post->description ?? 'No description available for this post.', 150) }}
                        </p>
                    </div>

                    <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between">
                        <div class="text-sm text-red-500">
                            By <span class="font-semibold text-green-700">{{ $post->user?->name ?? 'Unknown' }}</span>
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}"
                            class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 transition-colors inline-flex items-center group/link">
                            Read
                            <svg class="ml-1 h-4 w-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-gray-50 rounded-full p-4 mb-4">
                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No available posts</h3>
                    <p class="text-gray-500 mb-6 max-w-sm">
                        @if($q)
                            We couldn't find any posts matching "{{$q}}".
                        @else
                            There are no accepted posts to read yet.
                        @endif
                    </p>
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-all">
                        Refresh
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
