@extends('posts.layouts.app')

@section('title') Home @endsection

@section('search')
    <div class="container-fluid  w-50 m-auto">
        <form class="d-flex" action="{{route('posts.index')}}" method="GET">
            @csrf
            <input class="form-control me-2" name="search" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
@endsection

@section('content')

    <div class="d-flex justify-content-center p-3">
        <a  href="{{route('posts.create')}}"  class="btn btn-success" >Create Post</a>
    </div>
@if ($allposts->isEmpty())
    <div class="bg-red-200 rounded p-3">

        <p class="text-red-500 text-lg font-semibold">* There is no posts now</p>
    </div>
@else
    <table class="table" style="width:80%; margin:auto">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if (is_null($post))
            @foreach ($allposts as $post)
                <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->created_at->format('Y-m-d')}}</td>

                    <td>
                            <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">View</a>
                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                            <form style="display: inline;" method="POSt" action="{{route('posts.destroy',$post->id)}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</a>
                            </form>
                    </td>
                </tr>
            @endforeach
        @else
            @foreach ($unique_post as $unique_post )
                <tr>
                        <th scope="row">{{$unique_post->id}}</th>
                        <td>{{$unique_post->title}}</td>
                        <td>{{$unique_post->user->name}}</td>
                        <td>{{$unique_post->created_at->format('Y-m-d')}}</td>

                    <td>
                            <a href="{{route('posts.show',$unique_post->id)}}" class="btn btn-info">View</a>
                            <a href="{{route('posts.edit',$unique_post->id)}}" class="btn btn-primary">Edit</a>
                            <form style="display: inline;" method="POST" action="{{route('posts.destroy',$unique_post->id)}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</a>
                            </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    </table>

@endif
@endsection

