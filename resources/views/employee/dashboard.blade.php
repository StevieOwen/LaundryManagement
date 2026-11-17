
<x-employee-layout title="Dashboard">

    <div class="space-y-8">

        {{-- Welcome section --}}
        <div>
            <h1 class="text-2xl font-bold text-[#202A28]">
                Welcome back, {{ auth()->user()->name }}!
            </h1>
            <p class="mt-1 text-sm text-[#59645F]">
                Here's an overview of the orders you've received and their current status.
            </p>
            <p class="mt-2 text-xs font-medium text-[#59645F]">
                {{ now()->format('l, d F Y') }}
            </p>
        </div>

        {{-- Summary cards --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Today's orders --}}
            <div class="rounded-xl border border-[#D9D7CE] bg-[#FFFEFA] p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-[#59645F]">
                        Today's Orders
                    </p>
                    <div class="rounded-lg bg-[#244B46]/10 p-2.5 text-[#244B46]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M8 7h12M8 12h12M8 17h12M4 7h.01M4 12h.01M4 17h.01"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-[#202A28]">
                    {{ $orders_received_today }}
                </p>
                <p class="mt-1 text-xs text-[#59645F]">
                    Orders received today
                </p>
            </div>

            {{-- Ready for pickup --}}
            <div class="rounded-xl border border-[#D9D7CE] bg-[#FFFEFA] p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-[#59645F]">
                        Ready for Pickup
                    </p>
                    <div class="rounded-lg bg-green-100 p-2.5 text-green-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="m5 12 4 4L19 6"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-[#202A28]">
                    {{ $order_ready->total() }}
                </p>
                <p class="mt-1 text-xs text-[#59645F]">
                    Awaiting customer pickup
                </p>
            </div>

            {{-- Processing orders --}}
            <div class="rounded-xl border border-[#D9D7CE] bg-[#FFFEFA] p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-[#59645F]">
                        Processing Orders
                    </p>
                    <div class="rounded-lg bg-blue-100 p-2.5 text-blue-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M12 6v6l4 2m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-[#202A28]">
                    {{ $processing_order->total() }}
                </p>
                <p class="mt-1 text-xs text-[#59645F]">
                    Orders marked as washed
                </p>
            </div>

            {{-- Unpaid orders --}}
            <div class="rounded-xl border border-[#D9D7CE] bg-[#FFFEFA] p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-[#59645F]">
                        Unpaid Orders
                    </p>
                    <div class="rounded-lg bg-orange-100 p-2.5 text-orange-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M3 7h18v12H3zM3 10h18m-12 5h3"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-[#202A28]">
                    {{ $unpaid_orders->total() }}
                </p>
                <p class="mt-1 text-xs text-[#59645F]">
                    Orders awaiting payment
                </p>
            </div>

        </div>

        {{-- Recent orders --}}
        <section class="overflow-hidden rounded-xl border border-[#D9D7CE] bg-[#FFFEFA]">

            <div class="flex flex-col gap-3 border-b border-[#D9D7CE] px-5 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-semibold text-[#202A28]">
                        My Recent Orders
                    </h2>
                    <p class="mt-1 text-sm text-[#59645F]">
                        Orders you have registered in the system.
                    </p>
                </div>

                {{-- Replace with your actual employee orders route --}}
                <a href="{{ route('employee.orders') }}"
                   class="text-sm font-semibold text-[#244B46] hover:underline">
                    View All Orders →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[650px] text-left text-sm">
                    <thead class="bg-[#F4F1E8] text-xs uppercase tracking-wide text-[#59645F]">
                        <tr>
                            <th class="px-5 py-3 font-semibold">Order ID</th>
                            <th class="px-5 py-3 font-semibold">Items</th>
                            <th class="px-5 py-3 font-semibold">Date Received</th>
                            <th class="px-5 py-3 font-semibold">Processing Status</th>
                            <th class="px-5 py-3 font-semibold">Payment Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#D9D7CE]">
                        @forelse($orders as $order)
                            <tr class="transition hover:bg-[#F4F1E8]/60">
                                <td class="px-5 py-4 font-semibold text-[#244B46]">
                                    #{{ $order->id }}
                                </td>

                                <td class="px-5 py-4 text-[#59645F]">
                                    {{ $order->items->count() }}
                                    {{ Str::plural('item', $order->items->count()) }}
                                </td>

                                <td class="px-5 py-4 text-[#59645F]">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                                        {{ $order->processing_status === 'ready_for_pickup'
                                            ? 'bg-green-100 text-green-700'
                                            : ($order->processing_status === 'washed'
                                                ? 'bg-blue-100 text-blue-700'
                                                : 'bg-orange-100 text-orange-700') }}">
                                        {{ Str::headline($order->processing_status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                                        {{ $order->payment_status === 'paid'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-orange-100 text-orange-700' }}">
                                        {{ Str::headline($order->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="h-10 w-10 text-[#D9D7CE]"
                                             fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="1.5"
                                                  d="M8 7h12M8 12h12M8 17h12M4 7h.01M4 12h.01M4 17h.01"/>
                                        </svg>
                                        <p class="mt-3 font-medium text-[#202A28]">
                                            No orders yet
                                        </p>
                                        <p class="mt-1 text-sm text-[#59645F]">
                                            Orders you register will appear here.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-[#D9D7CE] px-5 py-4">
                {{ $orders->links() }}
            </div>
        </section>

        {{-- Order queues --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            {{-- Ready for pickup --}}
            <section class="overflow-hidden rounded-xl border border-[#D9D7CE] bg-[#FFFEFA]">
                <div class="flex items-center justify-between border-b border-[#D9D7CE] px-5 py-4">
                    <div>
                        <h2 class="font-semibold text-[#202A28]">
                            Ready for Pickup
                        </h2>
                        <p class="text-xs text-[#59645F]">
                            Orders awaiting collection
                        </p>
                    </div>
                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                        {{ $order_ready->total() }}
                    </span>
                </div>

                <div class="divide-y divide-[#D9D7CE]">
                    @forelse($order_ready as $order)
                        <div class="px-5 py-4">
                            <p class="font-semibold text-[#244B46]">
                                Order #{{ $order->id }}
                            </p>
                            <p class="mt-1 text-xs text-[#59645F]">
                                {{ $order->items->count() }} items
                                · {{ $order->created_at->format('d M Y') }}
                            </p>
                        </div>
                    @empty
                        <p class="px-5 py-8 text-center text-sm text-[#59645F]">
                            No orders ready for pickup.
                        </p>
                    @endforelse
                </div>

                <div class="border-t border-[#D9D7CE] px-5 py-3">
                    {{ $order_ready->links() }}
                </div>
            </section>

            {{-- Processing --}}
            <section class="overflow-hidden rounded-xl border border-[#D9D7CE] bg-[#FFFEFA]">
                <div class="flex items-center justify-between border-b border-[#D9D7CE] px-5 py-4">
                    <div>
                        <h2 class="font-semibold text-[#202A28]">
                            Processing
                        </h2>
                        <p class="text-xs text-[#59645F]">
                            Orders marked as washed
                        </p>
                    </div>
                    <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700">
                        {{ $processing_order->total() }}
                    </span>
                </div>

                <div class="divide-y divide-[#D9D7CE]">
                    @forelse($processing_order as $order)
                        <div class="px-5 py-4">
                            <p class="font-semibold text-[#244B46]">
                                Order #{{ $order->id }}
                            </p>
                            <p class="mt-1 text-xs text-[#59645F]">
                                {{ $order->items->count() }} items
                                · {{ $order->created_at->format('d M Y') }}
                            </p>
                        </div>
                    @empty
                        <p class="px-5 py-8 text-center text-sm text-[#59645F]">
                            No processing orders.
                        </p>
                    @endforelse
                </div>

                <div class="border-t border-[#D9D7CE] px-5 py-3">
                    {{ $processing_order->links() }}
                </div>
            </section>

            {{-- Unpaid --}}
            <section class="overflow-hidden rounded-xl border border-[#D9D7CE] bg-[#FFFEFA]">
                <div class="flex items-center justify-between border-b border-[#D9D7CE] px-5 py-4">
                    <div>
                        <h2 class="font-semibold text-[#202A28]">
                            Unpaid Orders
                        </h2>
                        <p class="text-xs text-[#59645F]">
                            Orders awaiting payment
                        </p>
                    </div>
                    <span class="rounded-full bg-orange-100 px-2.5 py-1 text-xs font-semibold text-orange-700">
                        {{ $unpaid_orders->total() }}
                    </span>
                </div>

                <div class="divide-y divide-[#D9D7CE]">
                    @forelse($unpaid_orders as $order)
                        <div class="px-5 py-4">
                            <p class="font-semibold text-[#244B46]">
                                Order #{{ $order->id }}
                            </p>
                            <p class="mt-1 text-xs text-[#59645F]">
                                {{ $order->items->count() }} items
                                · {{ $order->created_at->format('d M Y') }}
                            </p>
                        </div>
                    @empty
                        <p class="px-5 py-8 text-center text-sm text-[#59645F]">
                            No unpaid orders.
                        </p>
                    @endforelse
                </div>

                <div class="border-t border-[#D9D7CE] px-5 py-3">
                    {{ $unpaid_orders->links() }}
                </div>
            </section>

        </div>

    </div>

</x-employee-layout>
