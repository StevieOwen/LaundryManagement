
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Dashboard' }} | Foldline</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans 3', sans-serif;
        }

        h1, h2, h3, .brand {
            font-family: 'Manrope', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-[#F4F1E8] text-[#202A28] antialiased"
      x-data="{ sidebarOpen: false }">

    <div class="min-h-screen">

        <!-- Mobile overlay -->
        <div
            x-show="sidebarOpen"
            x-cloak
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-[#202A28]/50 lg:hidden"
        ></div>

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-[#D9D7CE] bg-[#FFFEFA] transition-transform duration-300 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <!-- Brand -->
            <div class="flex h-20 items-center justify-between border-b border-[#D9D7CE] px-6">
                <a href="{{ url('/admin') }}" class="brand flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#244B46] text-sm font-extrabold text-white">
                        F
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-[#244B46]">
                        Foldline
                    </span>
                </a>

                <button
                    @click="sidebarOpen = false"
                    class="rounded-lg p-2 text-[#59645F] hover:bg-[#F4F1E8] lg:hidden"
                    aria-label="Close sidebar"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 space-y-1 px-4 py-6">

                <p class="mb-3 px-3 text-xs font-bold uppercase tracking-widest text-[#9A9E98]">
                    Workspace
                </p>

                <!-- Dashboard -->
                <a href="{{ route('admin') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin') ? 'bg-[#244B46] text-white' : 'text-[#59645F] hover:bg-[#F4F1E8] hover:text-[#244B46]' }}">
                        <!-- Keep the existing dashboard SVG icon -->
                    Dashboard
                </a>

                <!-- Users -->
                <a href="{{ route('admin.users') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin.users') ? 'bg-[#244B46] text-white' : 'text-[#59645F] hover:bg-[#F4F1E8] hover:text-[#244B46]' }}">
                        <!-- Keep the existing users SVG icon -->
                    Users
                </a>

                <!-- Items -->
                <a href="{{ route('admin.items') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin.items') ? 'bg-[#244B46] text-white' : 'text-[#59645F] hover:bg-[#F4F1E8] hover:text-[#244B46]' }}">
                        <!-- Keep the existing items SVG icon -->
                    Items
                </a>

                <!-- Categories -->
                <a href="{{ route('admin.categories') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin.categories') ? 'bg-[#244B46] text-white' : 'text-[#59645F] hover:bg-[#F4F1E8] hover:text-[#244B46]' }}">
                        <!-- Keep the existing categories SVG icon -->
                    Categories
                </a>

                <div class="my-5 border-t border-[#EAE8E0]"></div>

                <p class="mb-3 px-3 text-xs font-bold uppercase tracking-widest text-[#9A9E98]">
                    Preferences
                </p>

                <!-- Settings -->
                <a href="{{route('admin.settings')}}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-[#59645F] hover:bg-[#F4F1E8]">
                        <!-- Keep the existing settings SVG icon -->
                    Settings
                </a>
            </nav>

            <!-- Sidebar footer -->
            <div class="border-t border-[#D9D7CE] p-5">
                <div class="rounded-xl bg-[#F4F1E8] p-4">
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#59645F]">
                        Foldline workspace
                    </p>
                    <p class="mt-1 text-sm font-semibold text-[#244B46]">
                        Care in every detail.
                    </p>
                </div>
            </div>
        </aside>

        <!-- Main area -->
        <div class="min-h-screen lg:pl-64">

            <!-- Topbar -->
            <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-[#D9D7CE] bg-[#FFFEFA]/95 px-4 backdrop-blur sm:px-6 lg:px-8">

                <div class="flex items-center gap-3">
                    <button
                        @click="sidebarOpen = true"
                        class="rounded-lg p-2 text-[#59645F] hover:bg-[#F4F1E8] lg:hidden"
                        aria-label="Open sidebar"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div>
                        <p class="text-sm font-semibold text-[#202A28]">
                            Admin workspace
                        </p>
                        <p class="hidden text-xs text-[#7A837D] sm:block">
                            Manage your laundry operations
                        </p>
                    </div>
                </div>

                <!-- User information and logout -->
                <div class="flex items-center gap-3 sm:gap-5">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-bold text-[#202A28]">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </p>
                        <p class="text-xs text-[#7A837D]">
                            {{ auth()->user()->email ?? '' }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DCE8E4] text-sm font-bold text-[#244B46]">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="flex items-center gap-2 rounded-xl border border-[#D9D7CE] px-3 py-2 text-sm font-semibold text-[#59645F] transition hover:border-[#B45630] hover:bg-[#B45630] hover:text-white"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 17l5-5-5-5m5 5H3m9-9h6a2 2 0 012 2v14a2 2 0 01-2 2h-6"/>
                            </svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page content -->
            <main class="px-4 py-8 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>

        </div>
    </div>

</body>
</html>
