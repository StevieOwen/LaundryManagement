
<x-admin-layout>
    <x-slot:title>
        Categories
    </x-slot:title>

    <div
        x-data="{
            addOpen: false,
            editOpen: false,
            deleteOpen: false,

            selectedCategory: {
                id: '',
                name: '',
                description: ''
            },

            updateUrl: @js(route('admin.update_category', ['category' => '__CATEGORY__'])),
            deleteUrl: @js(route('admin.delete_category', ['category' => '__CATEGORY__'])),

            openEdit(category) {
                this.selectedCategory = { ...category };
                this.editOpen = true;
            },

            openDelete(category) {
                this.selectedCategory = { ...category };
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
                    Categories
                </h1>

                <p class="mt-2 text-[#59645F]">
                    Organize laundry categories and manage their descriptions.
                </p>
            </div>

            <!-- Add category button -->
            <button
                type="button"
                @click="addOpen = true"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#244B46] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#193B36]"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 5v14m-7-7h14"/>
                </svg>
                Add category
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

        <!-- Categories table -->
        <div class="overflow-hidden rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA]">

            <div class="border-b border-[#EAE8E0] p-5">
                <h2 class="text-lg font-bold text-[#202A28]">
                    All categories
                </h2>

                <p class="mt-1 text-sm text-[#7A837D]">
                    {{ $categories->total() }} registered categor{{ $categories->total() === 1 ? 'y' : 'ies' }}
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">

                    <thead class="bg-[#F4F1E8]">
                        <tr class="text-xs font-bold uppercase tracking-wider text-[#59645F]">
                            <th class="px-6 py-4">Category name</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#EAE8E0]">

                        @forelse($categories as $category)
                            <tr class="transition hover:bg-[#F9F7F1]">

                                <!-- Category name -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#DCE8E4] text-[#244B46]">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                      d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z"/>
                                            </svg>
                                        </div>

                                        <span class="font-semibold text-[#202A28]">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Description -->
                                <td class="px-6 py-4">
                                    <p class="max-w-md text-sm text-[#59645F]">
                                        {{ $category->description ?: 'No description provided' }}
                                    </p>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Edit -->
                                        <button
                                            type="button"
                                            @click="openEdit({
                                                id: {{ $category->id }},
                                                name: @js($category->name),
                                                description: @js($category->description ?? '')
                                            })"
                                            class="rounded-lg border border-[#D9D7CE] px-3 py-2 text-xs font-bold text-[#244B46] transition hover:border-[#244B46] hover:bg-[#DCE8E4]"
                                        >
                                            Edit
                                        </button>

                                        <!-- Delete -->
                                        <button
                                            type="button"
                                            @click="openDelete({
                                                id: {{ $category->id }},
                                                name: @js($category->name),
                                                description: @js($category->description ?? '')
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
                                        No categories found
                                    </p>

                                    <p class="mt-1 text-sm text-[#7A837D]">
                                        Add your first category to get started.
                                    </p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($categories->hasPages())
                <div class="border-t border-[#EAE8E0] px-5 py-4">
                    {{ $categories->links() }}
                </div>
            @endif

        </div>


        <!-- ================================= -->
        <!-- ADD CATEGORY MODAL                -->
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

                <div class="flex items-center justify-between border-b border-[#EAE8E0] px-6 py-5">
                    <div>
                        <h2 class="text-xl font-extrabold text-[#202A28]">
                            Add new category
                        </h2>

                        <p class="mt-1 text-sm text-[#7A837D]">
                            Create a new laundry category.
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

                <form action="{{ route('admin.store_categories') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-5">

                        <!-- Name -->
                        <div>
                            <label for="add_name" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Category name
                            </label>

                            <input
                                type="text"
                                id="add_name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                maxlength="255"
                                placeholder="e.g. Regular, Delicate, Dry cleaning"
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >

                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="add_description" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Description
                                <span class="font-normal text-[#7A837D]">(optional)</span>
                            </label>

                            <textarea
                                id="add_description"
                                name="description"
                                rows="4"
                                placeholder="Describe this category..."
                                class="w-full resize-none rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >{{ old('description') }}</textarea>

                            @error('description')
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
                            Create category
                        </button>
                    </div>

                </form>

            </div>
        </div>


        <!-- ================================= -->
        <!-- EDIT CATEGORY MODAL               -->
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

                <div class="flex items-center justify-between border-b border-[#EAE8E0] px-6 py-5">
                    <div>
                        <h2 class="text-xl font-extrabold text-[#202A28]">
                            Edit category
                        </h2>

                        <p class="mt-1 text-sm text-[#7A837D]">
                            Update the category information.
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

                <form
                    method="POST"
                    :action="updateUrl.replace('__CATEGORY__', selectedCategory.id)"
                    class="p-6"
                >
                    @csrf
                    @method('PATCH')

                    <div class="space-y-5">

                        <!-- Name -->
                        <div>
                            <label for="edit_name" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Category name
                            </label>

                            <input
                                type="text"
                                id="edit_name"
                                name="name"
                                x-model="selectedCategory.name"
                                required
                                maxlength="255"
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="edit_description" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Description
                            </label>

                            <textarea
                                id="edit_description"
                                name="description"
                                rows="4"
                                x-model="selectedCategory.description"
                                class="w-full resize-none rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            ></textarea>
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
                    Delete category?
                </h2>

                <p class="mt-2 text-sm leading-6 text-[#59645F]">
                    Are you sure you want to delete
                    <strong x-text="selectedCategory.name"></strong>?
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
                        :action="deleteUrl.replace('__CATEGORY__', selectedCategory.id)"
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
