@extends('posts.layouts.app')

@section('title') Create Blog @endsection

@section('content')
<div class="container_form mt-5" style="width: 75%; margin:auto;">
    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="description" class="mb-2">Description</label>
            <textarea class="form-control" name="description"  id="description" style="height: 100px"></textarea>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Post Creator</label>
            <input type="text" name="post_creator" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

    </form>
</div>

@endsection
