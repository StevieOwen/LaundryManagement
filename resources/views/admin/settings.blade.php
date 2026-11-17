
<x-admin-layout>
    <x-slot:title>
        Settings
    </x-slot:title>

    <div class="space-y-8">

        {{-- Page heading --}}
        <div>
            <h1 class="text-2xl font-bold text-[#202A28]">
                Settings
            </h1>
            <p class="mt-1 text-sm text-[#59645F]">
                Manage your business information and account preferences.
            </p>
        </div>

        {{-- Business Information --}}
        <section class="overflow-hidden rounded-xl border border-[#D9D7CE] bg-[#FFFEFA]">

            <div class="border-b border-[#D9D7CE] px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#244B46]/10">
                        <svg class="h-5 w-5 text-[#244B46]" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-[#202A28]">
                            Business Information
                        </h2>
                        <p class="text-sm text-[#59645F]">
                            Update your laundry business details.
                        </p>
                    </div>
                </div>
            </div>

            <form action="#" method="POST" class="space-y-5 p-6" enctype="multipart/form-data">
                @csrf

                {{-- Business name --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                        Business Name
                    </label>
                    <input type="text" name="business_name"
                           placeholder="Enter business name"
                           class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10">
                </div>

                {{-- Address --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                        Business Address
                    </label>
                    <textarea name="business_address" rows="3"
                              placeholder="Enter business address"
                              class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"></textarea>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    {{-- Phone --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                            Phone Number
                        </label>
                        <input type="text" name="business_phone"
                               placeholder="Enter phone number"
                               class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                            Business Email
                        </label>
                        <input type="email" name="business_email"
                               placeholder="Enter business email"
                               class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10">
                    </div>
                </div>

                {{-- Logo --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                        Business Logo
                    </label>
                    <input type="file" name="business_logo" accept="image/*"
                           class="block w-full rounded-lg border border-[#D9D7CE] bg-white text-sm text-[#59645F] file:mr-4 file:border-0 file:bg-[#244B46]/10 file:px-4 file:py-2.5 file:font-medium file:text-[#244B46]">
                    <p class="mt-1 text-xs text-[#59645F]">
                        Upload a PNG, JPG or JPEG image.
                    </p>
                </div>

                <div class="flex justify-end border-t border-[#D9D7CE] pt-5">
                    <button type="submit"
                            class="rounded-lg bg-[#244B46] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#193B37]">
                        Save Business Information
                    </button>
                </div>
            </form>
        </section>

        {{-- Account Information --}}
        <section class="overflow-hidden rounded-xl border border-[#D9D7CE] bg-[#FFFEFA]">

            <div class="border-b border-[#D9D7CE] px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#244B46]/10">
                        <svg class="h-5 w-5 text-[#244B46]" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m8-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-[#202A28]">
                            Account Information
                        </h2>
                        <p class="text-sm text-[#59645F]">
                            Update your personal account details.
                        </p>
                    </div>
                </div>
            </div>

            <form action="#" method="POST" class="space-y-5 p-6">
                @csrf
                @method('PATCH')

                <div class="grid gap-5 sm:grid-cols-2">
                    {{-- Name --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                            Full Name
                        </label>
                        <input type="text" name="name"
                               value="{{ old('name', $user->name ?? 'Admin') }}"
                               required
                               class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                            Email Address
                        </label>
                        <input type="email" name="email"
                               value="{{ old('email', $user->email ?? 'admin@gmail.com') }}"
                               required
                               class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end border-t border-[#D9D7CE] pt-5">
                    <button type="submit"
                            class="rounded-lg bg-[#244B46] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#193B37]">
                        Update Account
                    </button>
                </div>
            </form>
        </section>

        {{-- Change Password --}}
        <section class="overflow-hidden rounded-xl border border-[#D9D7CE] bg-[#FFFEFA]">

            <div class="border-b border-[#D9D7CE] px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#B45630]/10">
                        <svg class="h-5 w-5 text-[#B45630]" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2Zm12-11V7a6 6 0 0 0-12 0v4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-[#202A28]">
                            Change Password
                        </h2>
                        <p class="text-sm text-[#59645F]">
                            Choose a strong password to protect your account.
                        </p>
                    </div>
                </div>
            </div>

            <form action="#" method="POST" class="space-y-5 p-6"
                  x-data="{ showCurrent: false, showNew: false, showConfirm: false }">
                @csrf
                @method('PATCH')

                {{-- Current password --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                        Current Password
                    </label>
                    <div class="relative">
                        <input :type="showCurrent ? 'text' : 'password'"
                               name="current_password" required
                               class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 pr-12 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10">
                        <button type="button" @click="showCurrent = !showCurrent"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#59645F]">
                            <span x-text="showCurrent ? 'Hide' : 'Show'" class="text-xs font-medium"></span>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    {{-- New password --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                            New Password
                        </label>
                        <div class="relative">
                            <input :type="showNew ? 'text' : 'password'"
                                   name="password" required
                                   class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 pr-12 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10">
                            <button type="button" @click="showNew = !showNew"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#59645F]">
                                <span x-text="showNew ? 'Hide' : 'Show'" class="text-xs font-medium"></span>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm password --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-[#202A28]">
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <input :type="showConfirm ? 'text' : 'password'"
                                   name="password_confirmation" required
                                   class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-2.5 pr-12 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10">
                            <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#59645F]">
                                <span x-text="showConfirm ? 'Hide' : 'Show'" class="text-xs font-medium"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end border-t border-[#D9D7CE] pt-5">
                    <button type="submit"
                            class="rounded-lg bg-[#244B46] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#193B37]">
                        Change Password
                    </button>
                </div>
            </form>
        </section>

    </div>
</x-admin-layout>
