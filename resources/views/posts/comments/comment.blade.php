<div
    class="bg-white rounded-xl shadow-sm border border-gray-100 p-6"
    x-data="{
        repliesOpen: false,
        replyFormOpen: false
    }"
>
    <div class="flex items-start space-x-4">
        <!-- Avatar -->
        <div class="flex-shrink-0">
            <div
                class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                {{ strtoupper($comment->user->name[0]) }}
            </div>
        </div>

        <!-- Content -->
        <div class="flex-1">
            <div class="flex items-center justify-between mb-1">
                <h4 class="text-sm font-bold text-gray-900">
                    {{ $comment->user->name }}
                </h4>
                <span class="text-xs text-gray-500">
                    {{-- {{ $comment->created_at->diffForHumans() }} --}}
                    N
                </span>
            </div>

            <p class="text-gray-600 text-sm mb-3">
                {{ $comment->comment }}
            </p>

            <!-- Actions -->
            <div class="flex items-center gap-4 text-xs text-gray-500 mt-3">
                @livewire('like-button', ['comment' => $comment])

                <button
                    class="hover:text-indigo-600 transition"
                    @click="replyFormOpen = !replyFormOpen"
                >
                    Reply
                </button>

                @if ($comment->replies_count > 0)
                    @livewire('load-replies',['comment' => $comment])
                @endif
            </div>


            <!-- Reply Form -->
            <div
                x-show="replyFormOpen"
                x-transition
                class="mt-4"
                style="display: none;"
            >
                <form class="space-y-3" method="POST" action="{{route('comments.store')}}">
                    @csrf
                    <textarea
                        name="comment"
                        rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                        placeholder="Write a reply..."></textarea>

                    <div class="flex justify-end space-x-2">
                        <input type="hidden" name="post_id" value="{{$post_id}}">
                        <input type="hidden" name="parent_id" value="{{$comment->id}}">
                        <button
                            type="button"
                            @click="replyFormOpen = false"
                            class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-800">
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="px-3 py-1.5 text-xs font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Post Reply
                        </button>
                    </div>
                </form>
            </div>

            <!-- Replies -->
            @if($comment->relationLoaded('replies'))
                <div
                    x-show="repliesOpen"
                    x-transition
                    class="mt-4 space-y-4 pl-6 border-l border-gray-200"
                    style="display: none;"
                >
                    @foreach ($comment->replies as $reply)
                        @include('posts.comments.comment', ['comment' => $reply])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
