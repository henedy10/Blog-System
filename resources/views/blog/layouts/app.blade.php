<!doctype html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Blog')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="h-full antialiased text-slate-800 bg-slate-50 flex flex-col selection:bg-indigo-500 selection:text-white">
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-xl border-b border-white/20 shadow-sm supports-[backdrop-filter]:bg-white/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-8">
                    <a href="{{ route('blog.index') }}" class="group flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:shadow-indigo-500/30 transition-shadow">
                            B
                        </div>
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-800 to-slate-600 tracking-tight">
                            blog
                        </span>
                    </a>

                    <a href="{{ route('blog.index') }}" class="hidden sm:inline-flex px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                        Available Posts
                    </a>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                            Dashboard
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                                Logout
                            </button>
                        </form>
                        
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-md text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-sm">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 pt-24 pb-12">
        @yield('content')
    </main>
</body>
</html>

