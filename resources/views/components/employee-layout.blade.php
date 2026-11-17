
@props(['title' => 'Employee Dashboard'])

@php
    $user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | Foldline</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F4F1E8] text-[#202A28] antialiased"
      x-data="{ sidebarOpen: false }">

    <div class="min-h-screen">

        {{-- Mobile sidebar overlay --}}
        <div
            x-cloak
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/40 lg:hidden">
        </div>

        {{-- Sidebar --}}
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-[#D9D7CE] bg-[#FFFEFA] transition-transform duration-300 lg:translate-x-0">

            {{-- Logo --}}
            <div class="flex h-20 items-center gap-3 border-b border-[#D9D7CE] px-6">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#244B46] text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-bold tracking-tight text-[#244B46]">
                        Foldline
                    </h1>
                    <p class="text-xs text-[#59645F]">
                        Laundry Management
                    </p>
                </div>

                {{-- Mobile close button --}}
                <button
                    type="button"
                    @click="sidebarOpen = false"
                    class="ml-auto rounded-lg p-2 text-[#59645F] hover:bg-[#F4F1E8] lg:hidden">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 space-y-1 px-4 py-6">

                <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-[#59645F]">
                    Workspace
                </p>

                {{-- Dashboard --}}
                <a href="{{ route('employee.dashboard') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium transition
                   {{ request()->routeIs('employee.dashboard') ? 'bg-[#244B46]/10 text-[#244B46]' : 'text-[#59645F] hover:bg-[#F4F1E8] hover:text-[#202A28]' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1.8"
                              d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10Z"/>
                    </svg>
                    Dashboard
                </a>

                {{-- Orders --}}
                <a href="{{ route('employee.orders') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium transition
                   {{ request()->routeIs('employee.orders*') ? 'bg-[#244B46]/10 text-[#244B46]' : 'text-[#59645F] hover:bg-[#F4F1E8] hover:text-[#202A28]' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M4 7h16v13H4zM8 7V4h8v3M8 11h8M8 15h5"/>
                    </svg>
                    Orders
                </a>

                {{-- Payments --}}
                <a href="{{ route('employee.payments') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium transition
                   {{ request()->routeIs('employee.payments*') ? 'bg-[#244B46]/10 text-[#244B46]' : 'text-[#59645F] hover:bg-[#F4F1E8] hover:text-[#202A28]' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M3 7h18v12H3zM3 10h18M7 15h3"/>
                    </svg>
                    Payments
                </a>

                {{-- Settings --}}
                <a href="{{ route('employee.settings') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium transition
                   {{ request()->routeIs('employee.settings*') ? 'bg-[#244B46]/10 text-[#244B46]' : 'text-[#59645F] hover:bg-[#F4F1E8] hover:text-[#202A28]' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm0-5v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64"/>
                    </svg>
                    Settings
                </a>

            </nav>

            {{-- Sidebar footer --}}
            <div class="border-t border-[#D9D7CE] p-4">
                <div class="flex items-center gap-3 rounded-lg bg-[#F4F1E8] p-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#244B46] text-sm font-semibold text-white">
                        {{ strtoupper(substr($user->name?? 'Employee', 0, 1)) }}
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-[#202A28]">
                            {{ $user->name ?? 'Employee' }}
                        </p>
                        <p class="truncate text-xs text-[#59645F]">
                            Employee
                        </p>
                    </div>
                </div>
            </div>

        </aside>

        {{-- Main content area --}}
        <div class="min-h-screen lg:pl-64">

            {{-- Top navbar --}}
            <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-[#D9D7CE] bg-[#FFFEFA] px-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-3">

                    {{-- Mobile menu button --}}
                    <button
                        type="button"
                        @click="sidebarOpen = true"
                        class="rounded-lg p-2 text-[#244B46] hover:bg-[#F4F1E8] lg:hidden">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div>
                        <h2 class="text-lg font-semibold text-[#202A28]">
                            {{ $title }}
                        </h2>
                        <p class="hidden text-xs text-[#59645F] sm:block">
                            Welcome back, {{ $user->name ?? 'Employee' }}
                        </p>
                    </div>
                </div>

                {{-- Employee information and logout --}}
                <div class="flex items-center gap-3 sm:gap-5">

                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-semibold text-[#202A28]">
                            {{ $user->name ?? 'Employee' }}
                        </p>
                        <p class="text-xs text-[#59645F]">
                            {{ $user->email ?? ''}}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#244B46] text-sm font-semibold text-white">
                        {{  strtoupper(substr($user->name ?? 'Employee', 0, 1)) }}
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-2 rounded-lg border border-[#D9D7CE] px-3 py-2 text-sm font-medium text-[#59645F] transition hover:border-[#B45630] hover:bg-[#B45630]/5 hover:text-[#B45630]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M9 17l5-5-5-5m5 5H3m9-9h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"/>
                            </svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>

                </div>
            </header>

            {{-- Page content --}}
            <main class="p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

        </div>
    </div>

</body>
</html>
