@extends('posts.layouts.app')

@section('title') Edit Blog @endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container_form mt-5" style="width: 75%; margin:auto;">
    <form method="POST" action="{{route('posts.update',$post->id)}}">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" name="title" value="{{$post->title}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="description" class="mb-2">Description</label>
            <textarea class="form-control" name="description" id="description" style="height: 100px">{{$post->description}}</textarea>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Post Creator</label>
            <select name="post_creator" id="">
                @foreach ($creators as $create)
                <option  @selected($post->user->id==$create->id) value="{{$create->id}}">{{$create->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary"> Update </button>

    </form>
</div>

@endsection
