@extends('layouts.app')

@section('title') Home @endsection

@section('content')
      <div class="d-flex justify-content-center p-3">
        <button class="btn btn-success " type="button">Create Post</button>
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
        <th scope="row">{{$post['id']}}</th>
        <td>{{$post['Title']}}</td>
        <td>{{$post['Posted_By']}}</td>
        <td>{{$post['Created_At']}}</td>
        <td>
          <a href="{{route('posts.show',$post['id'])}}" class="btn btn-info">View</a>
          <a href="#" class="btn btn-primary">Edit</a>
          <a href="#" class="btn btn-danger">Delete</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
