<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">
                Blogs 
                <a href="/posts">all posts</a>
            </span>
            
        </div>
    </nav>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>