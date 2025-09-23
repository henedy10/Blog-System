<div>
    <div class="container-fluid  w-50 m-auto">
        <input class="form-control me-2" type="text" wire:model.live="query"  placeholder="Search Posts, Authors" >
    </div>

    <div class="d-flex justify-content-center p-3">
        <a  href="{{route('posts.create')}}"  class="btn btn-success" >Create Post</a>
    </div>

    <table class="table" style="width:80%; margin:auto">
        @if ($posts->count() > 0)
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
        @endif

        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <th scope="row">{{( $posts->firstItem() ?? 0 ) + $loop->index}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->created_at->format('Y-m-d')}}</td>
                    <td>
                        <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">View</a>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                        <form style="display: inline;" method="POSt" action="{{route('posts.destroy',$post->id)}}" onsubmit="return confirmDelete();">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</a>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-200 shadow-sm">
                    <!-- Icon -->
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-red-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                    </div>

                    <!-- Text -->
                    <p class="text-red-700 text-base font-medium">
                        There is no posts.
                    </p>
                </div>
            @endforelse
        </tbody>
    </table>
    <div class="mt-1.5 ml-1.5">
        {{$posts->links('livewire::simple-bootstrap') }}
    </div>
</div>
