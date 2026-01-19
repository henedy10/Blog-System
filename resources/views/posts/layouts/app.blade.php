<!doctype html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Blog')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    {{-- Keeping Bootstrap for compatibility --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Refined Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* Slate 300 */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; /* Slate 400 */
        }
    </style>
    @livewireStyles
</head>
<body class="h-full antialiased text-slate-800 bg-slate-50 flex flex-col selection:bg-indigo-500 selection:text-white">

    <!-- Glassmorphic Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-xl border-b border-white/20 shadow-sm supports-[backdrop-filter]:bg-white/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('posts.index') }}" class="group flex items-center gap-2">
                             <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:shadow-indigo-500/30 transition-shadow">
                                B
                             </div>
                            <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-800 to-slate-600 tracking-tight">
                                blog
                            </span>
                        </a>
                    </div>
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-1">
                        <a href="{{ route('posts.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-all relative group">
                            All Posts
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                     <!-- Search Trigger could go here -->

                    <div class="flex items-center">
                         <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-3 pl-3 pr-2 py-1.5 rounded-full hover:bg-slate-100 transition-colors focus:outline-none ring-2 ring-transparent focus:ring-indigo-100">
                                    <div class="text-right hidden md:block">
                                         <p class="text-sm font-semibold text-slate-700 leading-none">{{ Auth::user()->name }}</p>
                                         <p class="text-xs text-slate-400 mt-0.5">{{Auth::user()->role}}</p>
                                    </div>
                                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 p-0.5 shadow-md">
                                        <div class="h-full w-full rounded-full bg-slate-50 flex items-center justify-center text-indigo-700 font-bold text-sm">
                                             {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                                        </div>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Account</p>
                                </div>

                                <x-dropdown-link :href="route('profile.edit')" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="group flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700">
                                        <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 pt-24 pb-12"> <!-- Padding top to account for fixed navbar -->
        <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="rounded-xl bg-green-50 p-4 border border-green-200 shadow-sm mb-8 flex items-center justify-between animate-fade-in-down">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                             <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                         <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this post? This action cannot be undone.");
        }
    </script>
    @livewireScripts
</body>
</html>
