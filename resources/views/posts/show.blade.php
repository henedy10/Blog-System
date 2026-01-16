@extends('posts.layouts.app')

@section('title') blog @endsection

@section('content')

@if(session('successUpdatePost'))
    <div class="d-flex justify-content-center align-items-center mt-1">
        <span class="alert alert-success text-center w-50">
            {{session('successUpdatePost')}}
        </span>
    </div>
@endif

<div class="container_cards" style="width: 75%; margin: auto">
    <div class="card mt-5">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title : {{$post->title}}</h5>
            <p class="card-text">Description : {{$post->description}}</p>
            <p class="card-text">Created At : {{$post->created_at}}</p>
        </div>
    </div>
</div>
@endsection
