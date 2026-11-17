
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sign In | Foldline</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS and Alpine.js through Laravel Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Source Sans 3', sans-serif;
        }

        h1, h2, h3, .font-heading {
            font-family: 'Manrope', sans-serif;
        }

        .tabular {
            font-variant-numeric: tabular-nums;
        }

        .woven-pattern {
            background-image:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 7px,
                    rgba(255,255,255,.035) 8px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 7px,
                    rgba(255,255,255,.035) 8px
                );
        }
    </style>
</head>

<body class="min-h-screen bg-[#F4F1E8] text-[#202A28] antialiased">

<div class="min-h-screen grid lg:grid-cols-2">

    {{-- LEFT BRAND PANEL --}}
    <section class="relative hidden lg:flex flex-col justify-between overflow-hidden bg-[#244B46] text-[#F4F1E8] p-12 xl:p-16 woven-pattern">

        {{-- Decorative background --}}
        <div class="absolute -right-32 top-24 h-96 w-96 rounded-full border border-white/10"></div>
        <div class="absolute -right-20 top-36 h-72 w-72 rounded-full border border-white/10"></div>
        <div class="absolute -right-8 top-48 h-48 w-48 rounded-full border border-white/10"></div>

        {{-- Brand --}}
        <div class="relative z-10">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-lg border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="25" height="25" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor"
                         stroke-width="1.6" stroke-linecap="round">
                        <path d="M4 5h16M4 9h16M4 13h16M4 17h16"/>
                        <path d="M7 5v12M12 5v12M17 5v12"/>
                    </svg>
                </div>

                <span class="font-heading text-2xl font-extrabold tracking-[0.16em]">
                    FOLDLINE
                </span>
            </a>
        </div>

        {{-- Main branding content --}}
        <div class="relative z-10 max-w-xl">

            <div class="mb-8 inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-[#D4DFD8]">
                <span class="h-2 w-2 rounded-full bg-[#D8EBD9]"></span>
                Laundry Operations Management
            </div>

            <h1 class="font-heading text-5xl font-bold leading-[1.15] tracking-tight xl:text-6xl">
                Every garment
                <br>
                has a
                <span class="text-[#D8EBD9]">journey.</span>
            </h1>

            <p class="mt-7 max-w-md text-lg leading-8 text-[#D4DFD8]">
                Manage your laundry operations with clarity.
                From the moment garments arrive to the moment
                they are ready for collection.
            </p>

            {{-- Decorative woven ticket --}}
            <div class="mt-14 max-w-sm rotate-[-2deg] rounded-xl bg-[#F4F1E8] p-6 text-[#202A28] shadow-2xl">

                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#59645F]">
                            Laundry ticket
                        </p>
                        <h3 class="mt-2 font-heading text-2xl font-extrabold">
                            ORD-000125
                        </h3>
                    </div>

                    <span class="rounded-md bg-[#D8EBD9] px-3 py-1.5 text-xs font-bold text-[#286447]">
                        READY
                    </span>
                </div>

                <div class="my-5 border-t border-dashed border-[#D9D7CE]"></div>

                <div class="flex items-center justify-between text-sm">
                    <span class="text-[#59645F]">Garments received</span>
                    <span class="font-bold tabular">08 items</span>
                </div>

                <div class="mt-3 flex items-center justify-between text-sm">
                    <span class="text-[#59645F]">Order value</span>
                    <span class="font-bold tabular">16,500 RWF</span>
                </div>

                <div class="mt-5 flex items-center gap-1">
                    @foreach(['#DCE8E4','#E9E2C8','#D8E9F1','#EADFCF','#E8DDF0','#DDE5F4','#D8EBD9'] as $color)
                        <div class="h-1.5 flex-1 rounded-full" style="background: {{ $color }}"></div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="relative z-10 flex items-center justify-between text-xs text-[#D4DFD8]">
            <span>© {{ date('Y') }} Foldline. All rights reserved.</span>
            <span>Precision in every fold.</span>
        </div>

    </section>


    {{-- RIGHT LOGIN PANEL --}}
    <main class="flex min-h-screen items-center justify-center px-5 py-12 sm:px-10">

        <div
            class="w-full max-w-md"
            x-data="{
                showPassword: false,
                loading: false
            }"
        >

            {{-- Mobile logo --}}
            <div class="mb-12 flex justify-center lg:hidden">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#244B46] text-white">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="23" height="23" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor"
                             stroke-width="1.6" stroke-linecap="round">
                            <path d="M4 5h16M4 9h16M4 13h16M4 17h16"/>
                            <path d="M7 5v12M12 5v12M17 5v12"/>
                        </svg>
                    </div>

                    <span class="font-heading text-xl font-extrabold tracking-[0.16em]">
                        FOLDLINE
                    </span>
                </a>
            </div>

            {{-- Login heading --}}
            <div class="mb-9">
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-[#B45630]">
                    Employee portal
                </p>

                <h2 class="font-heading text-3xl font-bold tracking-tight sm:text-4xl">
                    Welcome back.
                </h2>

                <p class="mt-3 text-base leading-6 text-[#59645F]">
                    Sign in to manage your laundry operations.
                </p>
            </div>


            {{-- General error message --}}
            @if (session('error'))
                <div role="alert"
                     class="mb-6 flex gap-3 rounded-lg border border-[#E8B8B2] bg-[#FCECEA] p-4 text-sm text-[#A13D35]">

                    <svg class="mt-0.5 h-5 w-5 shrink-0"
                         viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8v4m0 4h.01"/>
                    </svg>

                    <div>
                        <p class="font-semibold">Login failed</p>
                        <p class="mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            @endif


            {{-- Success / password reset notification --}}
            @if (session('status'))
                <div role="status"
                     class="mb-6 rounded-lg border border-[#A9CBB4] bg-[#E8F3EA] p-4 text-sm text-[#286447]">
                    {{ session('status') }}
                </div>
            @endif


            {{-- Login form --}}
            <form
                action="{{ route('login') }}"
                method="POST"
                @submit="loading = true"
                novalidate="false"
                class="space-y-6"
            >
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label for="email"
                           class="mb-2 block text-sm font-semibold text-[#202A28]">
                        Email address
                    </label>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="h-5 w-5 text-[#59645F]"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.7">
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <path d="m3 7 9 6 9-6"/>
                            </svg>
                        </div>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="name@example.com"
                            autocomplete="email"
                            required
                            autofocus
                            @class([
                                'w-full rounded-lg border bg-[#FFFEFA] py-3.5 pl-12 pr-4 text-sm text-[#202A28] outline-none transition',
                                'border-[#A13D35] focus:border-[#A13D35] focus:ring-2 focus:ring-[#A13D35]/15' => $errors->has('email'),
                                'border-[#D9D7CE] focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/15' => !$errors->has('email'),
                            ])
                        >
                    </div>

                    @error('email')
                        <p role="alert" class="mt-2 flex items-center gap-1.5 text-xs font-medium text-[#A13D35]">
                            <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 8v4m0 4h.01"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- PASSWORD --}}
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <label for="password"
                               class="block text-sm font-semibold text-[#202A28]">
                            Password
                        </label>

                        <a href=""
                           class="text-sm font-semibold text-[#244B46] transition hover:text-[#B45630] hover:underline">
                            Forgot password?
                        </a>
                    </div>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="h-5 w-5 text-[#59645F]"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.7">
                                <rect x="4" y="10" width="16" height="11" rx="2"/>
                                <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                            </svg>
                        </div>

                        <input
                            :type="showPassword ? 'text' : 'password'"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                            @class([
                                'w-full rounded-lg border bg-[#FFFEFA] py-3.5 pl-12 pr-14 text-sm text-[#202A28] outline-none transition',
                                'border-[#A13D35] focus:border-[#A13D35] focus:ring-2 focus:ring-[#A13D35]/15' => $errors->has('password'),
                                'border-[#D9D7CE] focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/15' => !$errors->has('password'),
                            ])
                        >

                        {{-- Show / Hide password --}}
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            :aria-label="showPassword ? 'Hide password' : 'Show password'"
                            :aria-pressed="showPassword.toString()"
                            class="absolute inset-y-0 right-0 flex items-center justify-center px-4 text-[#59645F] transition hover:text-[#244B46] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#244B46] rounded-r-lg"
                        >
                            <svg x-show="!showPassword" x-cloak
                                 class="h-5 w-5" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                            <svg x-show="showPassword" x-cloak
                                 class="h-5 w-5" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="m3 3 18 18"/>
                                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                <path d="M9.9 5.2A10.5 10.5 0 0 1 12 5c6.4 0 10 7 10 7a15 15 0 0 1-3.2 3.9"/>
                                <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7c1.2 0 2.3-.3 3.3-.7"/>
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <p role="alert" class="mt-2 flex items-center gap-1.5 text-xs font-medium text-[#A13D35]">
                            <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 8v4m0 4h.01"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- REMEMBER ME --}}
                <div class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        value="1"
                        class="h-4 w-4 rounded border-[#D9D7CE] accent-[#244B46] focus:ring-2 focus:ring-[#244B46]"
                    >

                    <label for="remember" class="cursor-pointer text-sm text-[#59645F]">
                        Remember me
                    </label>
                </div>


                {{-- LOGIN BUTTON --}}
                <button
                    type="submit"
                    :disabled="loading"
                    class="flex min-h-[52px] w-full items-center justify-center gap-3 rounded-lg bg-[#244B46] px-5 py-3.5 text-sm font-bold text-white shadow-sm transition duration-200 hover:bg-[#193B36] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#244B46] focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-70"
                >
                    {{-- Normal state --}}
                    <span x-show="!loading" class="flex items-center gap-2">
                        Sign in

                        <svg class="h-4 w-4" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14m-7-7 7 7-7 7"/>
                        </svg>
                    </span>

                    {{-- Loading state --}}
                    <span x-show="loading" x-cloak class="flex items-center gap-3">
                        <svg class="h-5 w-5 animate-spin"
                             viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9"
                                    stroke="currentColor" stroke-width="3"
                                    class="opacity-25"/>
                            <path d="M21 12a9 9 0 0 0-9-9"
                                  stroke="currentColor" stroke-width="3"
                                  stroke-linecap="round"/>
                        </svg>

                        Signing in...
                    </span>
                </button>

            </form>


            {{-- Footer --}}
            <div class="mt-10 border-t border-[#D9D7CE] pt-6 text-center">
                <p class="text-xs leading-5 text-[#59645F]">
                    Authorized personnel only.
                    <br>
                    Your access is protected by Foldline.
                </p>

                <p class="mt-4 text-[11px] text-[#8A918C]">
                    © {{ date('Y') }} Foldline · Laundry Management System
                </p>
            </div>

        </div>
    </main>

</div>

</body>
</html>
