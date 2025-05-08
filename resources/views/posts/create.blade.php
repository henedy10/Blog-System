@extends('posts.layouts.app')

@section('title') Create Blog @endsection

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
    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" name="title" value="{{old('title')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="description" class="mb-2">Description</label>
            <textarea class="form-control" name="description"  id="description" style="height: 100px">{{old('description')}}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select style=" border-radius:5px;" name="post_creator" >
                @foreach ($creators as $create)
                <option value="{{$create->id}}">{{$create->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>

    </form>
</div>
@endsection
