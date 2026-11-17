<x-admin-layout>

    <x-slot:title>
        Dashboard
    </x-slot:title>

    <!-- Page heading -->
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wider text-[#B45630]">
                Overview
            </p>
            <h1 class="mt-2 text-3xl font-extrabold text-[#202A28]">
                Dashboard
            </h1>
            <p class="mt-2 text-[#59645F]">
                Here's what's happening in your laundry business.
            </p>
        </div>

        <div class="text-sm text-[#59645F]">
            {{ now()->format('l, d F Y') }}
        </div>
    </div>

    <!-- Statistics cards -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <!-- Total orders -->
        <div class="rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA] p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-[#59645F]">
                    Total orders
                </p>
                <div class="rounded-xl bg-[#DCE8E4] p-3 text-[#244B46]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-[#202A28]">
                {{ number_format($total_orders) }}
            </h2>
            <p class="mt-1 text-xs text-[#7A837D]">
                All registered orders
            </p>
        </div>

        <!-- Ready orders -->
        <div class="rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA] p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-[#59645F]">
                    Ready for pickup
                </p>
                <div class="rounded-xl bg-[#D8EBD9] p-3 text-[#286447]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-[#286447]">
                {{ number_format($order_ready) }}
            </h2>
            <p class="mt-1 text-xs text-[#7A837D]">
                Orders awaiting collection
            </p>
        </div>

        <!-- Paid orders -->
        <div class="rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA] p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-[#59645F]">
                    Paid orders
                </p>
                <div class="rounded-xl bg-[#DCE8E4] p-3 text-[#244B46]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 2v8m0 0v2m0-2c-1.657 0-3-.895-3-2m3 2c1.657 0 3-.895 3-2"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-[#244B46]">
                {{ number_format($paid_orders) }}
            </h2>
            <p class="mt-1 text-xs text-[#7A837D]">
                Successfully paid orders
            </p>
        </div>

        <!-- Unpaid orders -->
        <div class="rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA] p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-[#59645F]">
                    Unpaid orders
                </p>
                <div class="rounded-xl bg-[#F5E5DB] p-3 text-[#B45630]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M12 9v4m0 4h.01M10.3 3.86L2.8 17a2 2 0 001.74 3h14.92a2 2 0 001.74-3l-7.5-13.14a2 2 0 00-3.4 0z"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-[#B45630]">
                {{ number_format($unpaid_orders) }}
            </h2>
            <p class="mt-1 text-xs text-[#7A837D]">
                Payments still outstanding
            </p>
        </div>

    </div>

    <!-- Financial overview -->
    <div class="mt-8">
        <h2 class="mb-4 text-lg font-bold text-[#202A28]">
            Financial overview
        </h2>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

            <div class="rounded-2xl bg-[#244B46] p-6 text-white">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-white/75">
                        Total revenue collected
                    </p>
                    <svg class="h-6 w-6 text-white/75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 2v8m0 0v2"/>
                    </svg>
                </div>

                <h3 class="mt-4 text-3xl font-extrabold">
                    {{ number_format($revenue, 0) }}
                    <span class="text-sm font-semibold">RWF</span>
                </h3>

                <p class="mt-2 text-xs text-white/65">
                    From all paid orders
                </p>
            </div>

            <div class="rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA] p-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-[#59645F]">
                        Outstanding payments
                    </p>
                    <div class="rounded-xl bg-[#F5E5DB] p-3 text-[#B45630]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 2v8m0 0v2"/>
                        </svg>
                    </div>
                </div>

                <h3 class="mt-4 text-3xl font-extrabold text-[#B45630]">
                    {{ number_format($outstanding_payment, 0) }}
                    <span class="text-sm font-semibold">RWF</span>
                </h3>

                <p class="mt-2 text-xs text-[#7A837D]">
                    From unpaid orders
                </p>
            </div>

        </div>
    </div>

    <!-- Recent orders -->
    <div class="mt-8 overflow-hidden rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA]">

        <div class="flex flex-col justify-between gap-3 border-b border-[#EAE8E0] p-5 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-lg font-bold text-[#202A28]">
                    Recent orders
                </h2>
                <p class="mt-1 text-sm text-[#7A837D]">
                    The latest orders registered in your laundry.
                </p>
            </div>

            <a href="{{ route('admin.orders') }}"
               class="inline-flex items-center gap-2 text-sm font-bold text-[#244B46] hover:text-[#B45630]">
                View all orders
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap text-left">
                <thead class="bg-[#F4F1E8]">
                    <tr class="text-xs font-bold uppercase tracking-wider text-[#59645F]">
                        <th class="px-5 py-4">Order ID</th>
                        <th class="px-5 py-4">Customer</th>
                        <th class="px-5 py-4">Items</th>
                        <th class="px-5 py-4">Total</th>
                        <th class="px-5 py-4">Processing</th>
                        <th class="px-5 py-4">Payment</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#EAE8E0]">

                    @forelse($orders as $order)
                        <tr class="transition hover:bg-[#F9F7F1]">

                            <td class="px-5 py-4">
                                <span class="font-bold text-[#244B46]">
                                    #{{ $order->id }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-semibold text-[#202A28]">
                                    {{ $order->client_name }}
                                </p>
                                <p class="mt-1 text-xs text-[#7A837D]">
                                    {{ $order->client_phone }}
                                </p>
                            </td>

                            <td class="max-w-xs px-5 py-4">
                                <p class="truncate text-sm text-[#59645F]">
                                    {{ $order->items->pluck('designation')->join(', ') ?: 'No items' }}
                                </p>
                                <p class="mt-1 text-xs text-[#7A837D]">
                                    {{ $order->items->count() }} item(s)
                                </p>
                            </td>

                            <td class="px-5 py-4 font-semibold text-[#202A28]">
                                {{ number_format($order->total_price, 0) }} RWF
                            </td>

                            <td class="px-5 py-4">
                                @php
                                    $processing = $order->processing_status;
                                @endphp

                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold
                                    {{ $processing === 'Ready_for_pickup'
                                        ? 'bg-[#D8EBD9] text-[#286447]'
                                        : 'bg-[#DCE8E4] text-[#244B46]' }}">
                                    {{ str_replace('_', ' ', $processing) }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                @if($order->payment_status === 'paid')
                                    <span class="inline-flex rounded-full bg-[#D8EBD9] px-3 py-1 text-xs font-bold text-[#286447]">
                                        Paid
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-[#F5E5DB] px-3 py-1 text-xs font-bold text-[#B45630]">
                                        Unpaid
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="h-10 w-10 text-[#9A9E98]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                                    </svg>
                                    <p class="mt-3 font-semibold text-[#202A28]">
                                        No orders yet
                                    </p>
                                    <p class="mt-1 text-sm text-[#7A837D]">
                                        Orders will appear here when they are registered.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <!-- Attention section -->
    <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2">

        <div class="flex items-start gap-4 rounded-2xl border border-[#E9D5C9] bg-[#FFF9F5] p-5">
            <div class="rounded-xl bg-[#F5E5DB] p-3 text-[#B45630]">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M12 9v4m0 4h.01M10.3 3.86L2.8 17a2 2 0 001.74 3h14.92a2 2 0 001.74-3l-7.5-13.14a2 2 0 00-3.4 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-[#202A28]">
                    Unpaid orders
                </h3>
                <p class="mt-1 text-sm text-[#7A837D]">
                    You currently have
                    <strong class="text-[#B45630]">{{ $unpaid_orders }}</strong>
                    orders with outstanding payments.
                </p>
            </div>
        </div>

        <div class="flex items-start gap-4 rounded-2xl border border-[#CFE0D0] bg-[#F5FAF5] p-5">
            <div class="rounded-xl bg-[#D8EBD9] p-3 text-[#286447]">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-[#202A28]">
                    Ready for collection
                </h3>
                <p class="mt-1 text-sm text-[#7A837D]">
                    There are
                    <strong class="text-[#286447]">{{ $order_ready }}</strong>
                    orders waiting for customer pickup.
                </p>
            </div>
        </div>

    </div>

</x-admin-layout>