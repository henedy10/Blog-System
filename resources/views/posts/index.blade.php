@extends('posts.layouts.app')

@section('title') Home @endsection

@section('content')
      <div class="d-flex justify-content-center p-3">
        <a  href="{{route('posts.create')}}"  class="btn btn-success" >Create Post</a>
      </div>
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
    @foreach ($allposts as $post)
      <tr>
        <th scope="row">{{$post->id}}</th>
        <td>{{$post->title}}</td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->created_at}}</td>
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
  </tbody>
</table>
@endsection
