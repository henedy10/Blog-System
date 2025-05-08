@extends('posts.layouts.app')

@section('title') blog @endsection

@section('content')



<div class="container_cards" style="width: 75%; margin: auto">
    <div class="card mt-5">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title : {{$post->title}}</h5>
            <p class="card-text">Description : {{$post->description}}</p>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name : {{$post->user->name}}</h5>
            <h5 class="card-title">Email : {{$post->user->email}}</h5>
            <p class="card-text">Created At : {{$post->created_at}}</p>
        </div>
    </div>
    <div class="card mt-5">
        <x-comments::index :model="$post" />
    </div>
</div>


@endsection

