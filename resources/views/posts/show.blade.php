@extends('posts.layouts.app')

@section('title') blog @endsection

@section('content')
    @foreach ($singlepost as $post)
    @if ($post['id']==$PostId)
    <div class="container_cards" style="width: 75%; margin: auto">
        <div class="card mt-5">
            <div class="card-header">
                Post Info
            </div>
            <div class="card-body">
                <h5 class="card-title">Title : {{$post['Title']}}</h5>
                <p class="card-text">Description : {{$post['Title']}} is cool language</p>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                Post Creator Info
            </div>
            <div class="card-body">
                <h5 class="card-title">Name : {{$post['Posted_By']}}</h5>
                <p class="card-text">Created At : {{$post['Created_At']}}</p>
            </div>
        </div>
    </div>
    @endif
    @endforeach
@endsection

