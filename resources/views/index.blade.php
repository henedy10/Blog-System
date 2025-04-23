<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
          <span class="navbar-brand mb-0 h1">Blogs</span>
        </div>
    </nav>
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
          <a href="/posts/{{$post['id']}}" class="btn btn-info">View</a>
          <a href="#" class="btn btn-primary">Edit</a>
          <a href="#" class="btn btn-danger">Delete</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
