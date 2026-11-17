<x-admin-layout>
    <x-slot:title>
        Items
    </x-slot:title>

    <div
        x-data="{
            addOpen: false,
            editOpen: false,
            deleteOpen: false,

            selectedItem: {
                id: '',
                designation: '',
                category_id: ''
            },

            updateUrl: @js(route('admin.update_item', ['item' => '__ITEM__'])),
            deleteUrl: @js(route('admin.delete_item', ['item' => '__ITEM__'])),

            openEdit(item) {
                this.selectedItem = { ...item };
                this.editOpen = true;
            },

            openDelete(item) {
                this.selectedItem = { ...item };
                this.deleteOpen = true;
            }
        }"
    >

        <!-- Page heading -->
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-[#B45630]">
                    Administration
                </p>

                <h1 class="mt-2 text-3xl font-extrabold text-[#202A28]">
                    Items
                </h1>

                <p class="mt-2 text-[#59645F]">
                    Manage the laundry items and their categories.
                </p>
            </div>

            <!-- Add item button -->
            <button
                type="button"
                @click="addOpen = true"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#244B46] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#193B36]"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 5v14m-7-7h14"/>
                </svg>
                Add item
            </button>
        </div>

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-[#CFE0D0] bg-[#F0F8F0] px-5 py-4 text-sm font-medium text-[#286447]">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error message -->
        @if(session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <!-- Items table -->
        <div class="overflow-hidden rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA]">

            <div class="flex flex-col justify-between gap-2 border-b border-[#EAE8E0] p-5 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-lg font-bold text-[#202A28]">
                        All items
                    </h2>

                    <p class="mt-1 text-sm text-[#7A837D]">
                        {{ $items->total() }} registered item(s)
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap text-left">

                    <thead class="bg-[#F4F1E8]">
                        <tr class="text-xs font-bold uppercase tracking-wider text-[#59645F]">
                            <th class="px-6 py-4">Designation</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#EAE8E0]">

                        @forelse($items as $item)
                            <tr class="transition hover:bg-[#F9F7F1]">

                                <!-- Designation -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#DCE8E4] text-[#244B46]">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>

                                        <span class="font-semibold text-[#202A28]">
                                            {{ $item->designation }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex rounded-full bg-[#E9E2C8] px-3 py-1 text-xs font-bold text-[#806A30]">
                                        {{ $item->category?->name ?? 'No category' }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Edit button -->
                                        <button
                                            type="button"
                                            @click="openEdit({
                                                id: {{ $item->id }},
                                                designation: @js($item->designation),
                                                category_id: @js($item->category_id)
                                            })"
                                            class="rounded-lg border border-[#D9D7CE] px-3 py-2 text-xs font-bold text-[#244B46] transition hover:border-[#244B46] hover:bg-[#DCE8E4]"
                                        >
                                            Edit
                                        </button>

                                        <!-- Delete button -->
                                        <button
                                            type="button"
                                            @click="openDelete({
                                                id: {{ $item->id }},
                                                designation: @js($item->designation),
                                                category_id: @js($item->category_id)
                                            })"
                                            class="rounded-lg border border-[#E9D5C9] px-3 py-2 text-xs font-bold text-[#B45630] transition hover:bg-[#B45630] hover:text-white"
                                        >
                                            Delete
                                        </button>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <p class="font-semibold text-[#202A28]">
                                        No items found
                                    </p>

                                    <p class="mt-1 text-sm text-[#7A837D]">
                                        Add your first laundry item to get started.
                                    </p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($items->hasPages())
                <div class="border-t border-[#EAE8E0] px-5 py-4">
                    {{ $items->links() }}
                </div>
            @endif

        </div>


        <!-- ================================= -->
        <!-- ADD ITEM MODAL                    -->
        <!-- ================================= -->

        <div
            x-show="addOpen"
            x-cloak
            x-transition.opacity
            @keydown.escape.window="addOpen = false"
            class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto bg-[#202A28]/60 p-4"
        >
            <div
                @click.outside="addOpen = false"
                x-transition.scale
                class="my-auto w-full max-w-lg rounded-2xl bg-[#FFFEFA] shadow-2xl"
            >

                <!-- Modal header -->
                <div class="flex items-center justify-between border-b border-[#EAE8E0] px-6 py-5">
                    <div>
                        <h2 class="text-xl font-extrabold text-[#202A28]">
                            Add new item
                        </h2>

                        <p class="mt-1 text-sm text-[#7A837D]">
                            Register a new laundry item.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="addOpen = false"
                        class="rounded-lg p-2 text-[#59645F] hover:bg-[#F4F1E8]"
                        aria-label="Close modal"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.store_items') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-5">

                        <!-- Designation -->
                        <div>
                            <label for="add_designation" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Item designation
                            </label>

                            <input
                                type="text"
                                id="add_designation"
                                name="designation"
                                value="{{ old('designation') }}"
                                required
                                placeholder="e.g. Shirt, Trousers, Jacket"
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >

                            @error('designation')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="add_category" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Category
                            </label>

                            <select
                                id="add_category"
                                name="category_id"
                                required
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >
                                <option value="">Select a category</option>

                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('category_id') == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-7 flex justify-end gap-3">
                        <button
                            type="button"
                            @click="addOpen = false"
                            class="rounded-xl border border-[#D9D7CE] px-5 py-3 text-sm font-bold text-[#59645F] hover:bg-[#F4F1E8]"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="rounded-xl bg-[#244B46] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#193B36]"
                        >
                            Create item
                        </button>
                    </div>

                </form>

            </div>
        </div>


        <!-- ================================= -->
        <!-- EDIT ITEM MODAL                   -->
        <!-- ================================= -->

        <div
            x-show="editOpen"
            x-cloak
            x-transition.opacity
            @keydown.escape.window="editOpen = false"
            class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto bg-[#202A28]/60 p-4"
        >
            <div
                @click.outside="editOpen = false"
                x-transition.scale
                class="my-auto w-full max-w-lg rounded-2xl bg-[#FFFEFA] shadow-2xl"
            >

                <!-- Modal header -->
                <div class="flex items-center justify-between border-b border-[#EAE8E0] px-6 py-5">
                    <div>
                        <h2 class="text-xl font-extrabold text-[#202A28]">
                            Edit item
                        </h2>

                        <p class="mt-1 text-sm text-[#7A837D]">
                            Update the item information.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="editOpen = false"
                        class="rounded-lg p-2 text-[#59645F] hover:bg-[#F4F1E8]"
                        aria-label="Close modal"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form
                    method="POST"
                    :action="updateUrl.replace('__ITEM__', selectedItem.id)"
                    class="p-6"
                >
                    @csrf
                    @method('PATCH')

                    <div class="space-y-5">

                        <!-- Designation -->
                        <div>
                            <label for="edit_designation" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Item designation
                            </label>

                            <input
                                type="text"
                                id="edit_designation"
                                name="designation"
                                x-model="selectedItem.designation"
                                required
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="edit_category" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Category
                            </label>

                            <select
                                id="edit_category"
                                name="category_id"
                                x-model="selectedItem.category_id"
                                required
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >
                                <option value="">Select a category</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="mt-7 flex justify-end gap-3">
                        <button
                            type="button"
                            @click="editOpen = false"
                            class="rounded-xl border border-[#D9D7CE] px-5 py-3 text-sm font-bold text-[#59645F] hover:bg-[#F4F1E8]"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="rounded-xl bg-[#244B46] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#193B36]"
                        >
                            Save changes
                        </button>
                    </div>

                </form>

            </div>
        </div>


        <!-- ================================= -->
        <!-- DELETE CONFIRMATION MODAL         -->
        <!-- ================================= -->

        <div
            x-show="deleteOpen"
            x-cloak
            x-transition.opacity
            @keydown.escape.window="deleteOpen = false"
            class="fixed inset-0 z-[100] flex items-center justify-center bg-[#202A28]/60 p-4"
        >
            <div
                @click.outside="deleteOpen = false"
                x-transition.scale
                class="w-full max-w-md rounded-2xl bg-[#FFFEFA] p-6 shadow-2xl"
            >

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#F5E5DB] text-[#B45630]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M12 9v4m0 4h.01M10.3 3.86L2.8 17a2 2 0 001.74 3h14.92a2 2 0 001.74-3l-7.5-13.14a2 2 0 00-3.4 0z"/>
                    </svg>
                </div>

                <h2 class="mt-5 text-xl font-extrabold text-[#202A28]">
                    Delete item?
                </h2>

                <p class="mt-2 text-sm leading-6 text-[#59645F]">
                    Are you sure you want to delete
                    <strong x-text="selectedItem.designation"></strong>?
                    This action cannot be undone.
                </p>

                <div class="mt-7 flex justify-end gap-3">

                    <button
                        type="button"
                        @click="deleteOpen = false"
                        class="rounded-xl border border-[#D9D7CE] px-5 py-3 text-sm font-bold text-[#59645F] hover:bg-[#F4F1E8]"
                    >
                        Cancel
                    </button>

                    <form
                        method="POST"
                        :action="deleteUrl.replace('__ITEM__', selectedItem.id)"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="rounded-xl bg-[#B45630] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#963F20]"
                        >
                            Yes, delete
                        </button>
                    </form>

                </div>

            </div>
        </div>

    </div>
</x-admin-layout>

