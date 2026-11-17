
<x-employee-layout title="Orders">
    <div
        x-data="{
            createModalOpen: false,
            detailsModalOpen: false,
            selectedOrder: {},
            itemRows: [
                { item_id: '', quantity: 1, unit_price: 0 }
            ],

            addItem() {
                this.itemRows.push({
                    item_id: '',
                    quantity: 1,
                    unit_price: 0
                });
            },

            removeItem(index) {
                if (this.itemRows.length > 1) {
                    this.itemRows.splice(index, 1);
                }
            },

            showDetails(order) {
                this.selectedOrder = order;
                this.detailsModalOpen = true;
            }
        }"
        class="space-y-6"
    >

        {{-- Page heading --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-[#202A28]">Orders</h1>
                <p class="mt-1 text-sm text-[#59645F]">
                    Manage customer orders, track their progress and record payments.
                </p>
            </div>

            <button
                type="button"
                @click="createModalOpen = true"
                class="inline-flex items-center justify-center rounded-lg bg-[#244B46] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#193B37]"
            >
                <span class="mr-2 text-lg">+</span>
                Create New Order
            </button>
        </div>

        {{-- Success message --}}
        @if(session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        {{-- General error message --}}
        @if(session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        {{-- Orders table --}}
        <div class="overflow-hidden rounded-xl border border-[#D9D7CE] bg-[#FFFEFA] shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#D9D7CE]">
                    <thead class="bg-[#F4F1E8]">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[#59645F]">
                                Order Number
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[#59645F]">
                                Pickup Date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[#59645F]">
                                Items
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[#59645F]">
                                Client Name
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[#59645F]">
                                Total Price
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-[#59645F]">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#D9D7CE]">
                        @forelse($orders as $order)
                            <tr class="transition hover:bg-[#F8F6F0]">
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-[#244B46]">
                                    {{ $order->order_number }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm text-[#59645F]">
                                    {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-[#59645F]">
                                    {{ $order->items->pluck('designation')->join(', ') }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[#202A28]">
                                    {{ $order->client_name }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-[#202A28]">
                                    {{ number_format($order->total_price) }} RWF
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">

                                        {{-- View details --}}
                                        <button
                                            type="button"
                                            @click="showDetails(@js([
                                                'order_number' => $order->order_number,
                                                'pickup_date' => \Carbon\Carbon::parse($order->pickup_date)->format('d M Y'),
                                                'client_name' => $order->client_name,
                                                'client_phone' => $order->client_phone,
                                                'total_price' => number_format($order->total_price),
                                                'payment_status' => $order->payment_status,
                                                'processing_status' => $order->processing_status,
                                                'items' => $order->items->map(fn($item) => [
                                                    'designation' => $item->designation,
                                                    'quantity' => $item->pivot->quantity ?? null,
                                                    'unit_price' => $item->pivot->unit_price ?? null,
                                                ])->values()
                                            ]))"
                                            class="rounded-lg border border-[#D9D7CE] px-3 py-2 text-xs font-semibold text-[#244B46] hover:bg-[#F4F1E8]"
                                        >
                                            View
                                        </button>

                                        @if($order->payment_status === 'unpaid')

                                            {{-- Edit order --}}
                                            <a
                                                href="{{ route('employee.orders.edit', $order->id) }}"
                                                class="rounded-lg border border-[#B45630] px-3 py-2 text-xs font-semibold text-[#B45630] hover:bg-orange-50"
                                            >
                                                Edit
                                            </a>

                                            {{-- Pay order --}}
                                            <form
                                                action="{{ route('employee.orders.pay', $order->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to record payment for this order?')"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="rounded-lg bg-[#244B46] px-3 py-2 text-xs font-semibold text-white hover:bg-[#193B37]"
                                                >
                                                    Pay
                                                </button>
                                            </form>

                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-sm font-semibold text-[#202A28]">
                                        No orders found
                                    </p>
                                    <p class="mt-1 text-sm text-[#59645F]">
                                        Create a new order to get started.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($orders->hasPages())
                <div class="border-t border-[#D9D7CE] px-6 py-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>


        {{-- CREATE ORDER MODAL --}}
        <div
            x-cloak
            x-show="createModalOpen"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/50 p-4"
            @keydown.escape.window="createModalOpen = false"
        >
            <div
                @click.outside="createModalOpen = false"
                class="my-8 w-full max-w-3xl rounded-xl bg-[#FFFEFA] shadow-xl"
            >
                <div class="flex items-center justify-between border-b border-[#D9D7CE] px-6 py-5">
                    <div>
                        <h2 class="text-xl font-bold text-[#202A28]">Create New Order</h2>
                        <p class="mt-1 text-sm text-[#59645F]">
                            Enter the client's information and select the laundry items.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="createModalOpen = false"
                        class="text-2xl text-[#59645F] hover:text-[#202A28]"
                    >
                        &times;
                    </button>
                </div>

                <form
                    action="{{ route('employee.storeOrders') }}"
                    method="POST"
                    class="max-h-[75vh] space-y-6 overflow-y-auto px-6 py-6"
                >
                    @csrf

                    {{-- Client information --}}
                    <div>
                        <h3 class="mb-4 text-sm font-bold uppercase tracking-wide text-[#244B46]">
                            Client Information
                        </h3>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-[#202A28]">
                                    Client Name
                                </label>
                                <input
                                    type="text"
                                    name="client_name"
                                    value="{{ old('client_name') }}"
                                    required
                                    maxlength="255"
                                    class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                                    placeholder="Enter client name"
                                >
                                @error('client_name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-[#202A28]">
                                    Client Phone
                                </label>
                                <input
                                    type="text"
                                    name="client_phone"
                                    value="{{ old('client_phone') }}"
                                    required
                                    maxlength="255"
                                    class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                                    placeholder="Enter phone number"
                                >
                                @error('client_phone')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-[#202A28]">
                                    Pickup Date
                                </label>
                                <input
                                    type="date"
                                    name="pickup_date"
                                    value="{{ old('pickup_date') }}"
                                    required
                                    min="{{ now()->toDateString() }}"
                                    class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                                >
                                @error('pickup_date')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-[#202A28]">
                                    Payment Status
                                </label>
                                <select
                                    name="payment_status"
                                    class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                                >
                                    <option value="unpaid" selected>Unpaid</option>
                                    <option value="paid">Paid</option>
                                </select>
                                @error('payment_status')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-[#202A28]">
                                    Processing Status
                                </label>
                                <select
                                    name="processing_status"
                                    required
                                    class="w-full rounded-lg border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                                >
                                    <option value="Not_washed">Not washed</option>
                                    <option value="Washed">Washed</option>
                                    <option value="Ironed">Ironed</option>
                                    <option value="Ready_for_pickup">Ready for pickup</option>
                                    <option value="Collected">Collected</option>
                                </select>
                                @error('processing_status')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Order items --}}
                    <div class="border-t border-[#D9D7CE] pt-5">
                        <div class="mb-4 flex items-center justify-between gap-3">
                            <div>
                                <h3 class="text-sm font-bold uppercase tracking-wide text-[#244B46]">
                                    Order Items
                                </h3>
                                <p class="mt-1 text-xs text-[#59645F]">
                                    Select items, then enter their quantities and unit prices.
                                </p>
                            </div>

                            <button
                                type="button"
                                @click="addItem()"
                                class="shrink-0 rounded-lg border border-[#244B46] px-3 py-2 text-xs font-semibold text-[#244B46] hover:bg-[#F4F1E8]"
                            >
                                + Add Item
                            </button>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(row, index) in itemRows" :key="index">
                                <div class="rounded-lg border border-[#D9D7CE] bg-[#F8F6F0] p-4">
                                    <div class="mb-3 flex items-center justify-between">
                                        <p class="text-sm font-semibold text-[#202A28]">
                                            Item <span x-text="index + 1"></span>
                                        </p>

                                        <button
                                            type="button"
                                            @click="removeItem(index)"
                                            :disabled="itemRows.length === 1"
                                            class="text-xs font-semibold text-red-600 hover:text-red-800 disabled:cursor-not-allowed disabled:opacity-30"
                                        >
                                            Remove
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                                        <div class="sm:col-span-3">
                                            <label class="mb-2 block text-xs font-medium text-[#59645F]">
                                                Select Item
                                            </label>

                                            <select
                                                :name="'items[' + index + '][item_id]'"
                                                x-model="row.item_id"
                                                required
                                                class="w-full rounded-lg border border-[#D9D7CE] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#244B46]"
                                            >
                                                <option value="">Choose an item</option>

                                                @foreach($items->groupBy(fn($item) => $item->category?->name ?? 'Uncategorized') as $categoryName => $categoryItems)
                                                    <optgroup label="{{ $categoryName }}">
                                                        @foreach($categoryItems as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->designation }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label class="mb-2 block text-xs font-medium text-[#59645F]">
                                                Quantity
                                            </label>
                                            <input
                                                type="number"
                                                :name="'items[' + index + '][quantity]'"
                                                x-model.number="row.quantity"
                                                min="1"
                                                step="1"
                                                required
                                                class="w-full rounded-lg border border-[#D9D7CE] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#244B46]"
                                            >
                                        </div>

                                        <div class="sm:col-span-2">
                                            <label class="mb-2 block text-xs font-medium text-[#59645F]">
                                                Unit Price (RWF)
                                            </label>
                                            <input
                                                type="number"
                                                :name="'items[' + index + '][unit_price]'"
                                                x-model.number="row.unit_price"
                                                min="0"
                                                step="1"
                                                required
                                                class="w-full rounded-lg border border-[#D9D7CE] bg-white px-3 py-2.5 text-sm outline-none focus:border-[#244B46]"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        @error('items')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Form actions --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-[#D9D7CE] pt-5 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            @click="createModalOpen = false"
                            class="rounded-lg border border-[#D9D7CE] px-5 py-3 text-sm font-semibold text-[#59645F] hover:bg-[#F4F1E8]"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="rounded-lg bg-[#244B46] px-5 py-3 text-sm font-semibold text-white hover:bg-[#193B37]"
                        >
                            Create Order
                        </button>
                    </div>
                </form>
            </div>
        </div>


        {{-- ORDER DETAILS MODAL --}}
        <div
            x-cloak
            x-show="detailsModalOpen"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/50 p-4"
            @keydown.escape.window="detailsModalOpen = false"
        >
            <div
                @click.outside="detailsModalOpen = false"
                class="my-8 w-full max-w-xl rounded-xl bg-[#FFFEFA] shadow-xl"
            >
                <div class="flex items-center justify-between border-b border-[#D9D7CE] px-6 py-5">
                    <div>
                        <h2 class="text-xl font-bold text-[#202A28]">Order Details</h2>
                        <p class="mt-1 text-sm text-[#59645F]" x-text="selectedOrder.order_number"></p>
                    </div>

                    <button
                        type="button"
                        @click="detailsModalOpen = false"
                        class="text-2xl text-[#59645F] hover:text-[#202A28]"
                    >
                        &times;
                    </button>
                </div>

                <div class="space-y-5 px-6 py-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p class="text-xs font-medium uppercase text-[#59645F]">Client Name</p>
                            <p class="mt-1 text-sm font-semibold text-[#202A28]" x-text="selectedOrder.client_name"></p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase text-[#59645F]">Client Phone</p>
                            <p class="mt-1 text-sm font-semibold text-[#202A28]" x-text="selectedOrder.client_phone"></p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase text-[#59645F]">Pickup Date</p>
                            <p class="mt-1 text-sm font-semibold text-[#202A28]" x-text="selectedOrder.pickup_date"></p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase text-[#59645F]">Total Price</p>
                            <p class="mt-1 text-sm font-bold text-[#244B46]">
                                <span x-text="selectedOrder.total_price"></span> RWF
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase text-[#59645F]">Payment Status</p>
                            <p
                                class="mt-1 text-sm font-semibold capitalize"
                                :class="selectedOrder.payment_status === 'paid' ? 'text-green-700' : 'text-orange-700'"
                                x-text="selectedOrder.payment_status"
                            ></p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase text-[#59645F]">Processing Status</p>
                            <p class="mt-1 text-sm font-semibold text-[#202A28]" x-text="selectedOrder.processing_status?.replaceAll('_', ' ')"></p>
                        </div>
                    </div>

                    <div class="border-t border-[#D9D7CE] pt-5">
                        <h3 class="mb-3 text-sm font-bold text-[#244B46]">Items in this Order</h3>

                        <template x-if="selectedOrder.items?.length">
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead>
                                        <tr class="border-b border-[#D9D7CE] text-left text-xs uppercase text-[#59645F]">
                                            <th class="py-2">Item</th>
                                            <th class="py-2">Quantity</th>
                                            <th class="py-2">Unit Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(item, index) in selectedOrder.items" :key="index">
                                            <tr class="border-b border-[#D9D7CE] last:border-0">
                                                <td class="py-3 font-medium text-[#202A28]" x-text="item.designation"></td>
                                                <td class="py-3 text-[#59645F]" x-text="item.quantity ?? '—'"></td>
                                                <td class="py-3 text-[#59645F]" x-text="item.unit_price !== null ? Number(item.unit_price).toLocaleString() + ' RWF' : '—'"></td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="flex justify-end border-t border-[#D9D7CE] px-6 py-4">
                    <button
                        type="button"
                        @click="detailsModalOpen = false"
                        class="rounded-lg bg-[#244B46] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#193B37]"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-employee-layout>
