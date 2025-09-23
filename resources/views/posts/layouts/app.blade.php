<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        @livewireStyles
    </head>
    <body>
        <nav class="flex justify-between mt-3">
            <div class="w-1/8 flex justify-around">
                <span class="text-lg font-bold">blogs</span>
                <a href="{{ route('posts.index') }}"
                    class="d-inline-block px-3 py-2 bg-primary text-white rounded text-decoration-none shadow-sm">
                    All Blogs
                </a>
            </div>
        </nav>
        <div class="mt-2">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
        <script>
            function confirmDelete() {
                return confirm("Are you sure to delete it?");
            }
        </script>
        @livewireScripts
    </body>
</html>
