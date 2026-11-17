<x-admin-layout>
    <x-slot:title>
        Users
    </x-slot:title>

    <div
        x-data="{
            addOpen: false,
            editOpen: false,
            deleteOpen: false,

            selectedUser: {
                id: '',
                name: '',
                email: '',
                role: 'employee',
                status: 'active'
            },

            updateUrl: @js(route('admin.update.user', ['user' => '__USER__'])),
            deleteUrl: @js(route('admin.delete_user', ['user' => '__USER__'])),

            openEdit(user) {
                this.selectedUser = { ...user };
                this.editOpen = true;
            },

            openDelete(user) {
                this.selectedUser = { ...user };
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
                    Users
                </h1>

                <p class="mt-2 text-[#59645F]">
                    Manage administrators and employees in your workspace.
                </p>
            </div>

            <!-- Add user button -->
            <button
                type="button"
                @click="addOpen = true"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#244B46] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#193B36]"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 5v14m-7-7h14"/>
                </svg>
                Add user
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

        <!-- Users table -->
        <div class="overflow-hidden rounded-2xl border border-[#D9D7CE] bg-[#FFFEFA]">

            <div class="flex flex-col justify-between gap-2 border-b border-[#EAE8E0] p-5 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-lg font-bold text-[#202A28]">
                        All users
                    </h2>
                    <p class="mt-1 text-sm text-[#7A837D]">
                        {{ $users->total() }} registered user(s)
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap text-left">

                    <thead class="bg-[#F4F1E8]">
                        <tr class="text-xs font-bold uppercase tracking-wider text-[#59645F]">
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#EAE8E0]">

                        @forelse($users as $user)
                            <tr class="transition hover:bg-[#F9F7F1]">

                                <!-- Name -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DCE8E4] font-bold text-[#244B46]">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>

                                        <span class="font-semibold text-[#202A28]">
                                            {{ $user->name }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Email -->
                                <td class="px-6 py-4 text-sm text-[#59645F]">
                                    {{ $user->email }}
                                </td>

                                <!-- Role -->
                                <td class="px-6 py-4">
                                    @if($user->role === 'admin')
                                        <span class="rounded-full bg-[#DCE8E4] px-3 py-1 text-xs font-bold text-[#244B46]">
                                            Administrator
                                        </span>
                                    @else
                                        <span class="rounded-full bg-[#E9E2C8] px-3 py-1 text-xs font-bold text-[#806A30]">
                                            Employee
                                        </span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if($user->status === 'active')
                                        <span class="inline-flex items-center gap-2 rounded-full bg-[#D8EBD9] px-3 py-1 text-xs font-bold text-[#286447]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#286447]"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 rounded-full bg-[#EAE8E0] px-3 py-1 text-xs font-bold text-[#59645F]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#7A837D]"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Edit button -->
                                        <button
                                            type="button"
                                            @click="openEdit({
                                                id: {{ $user->id }},
                                                name: @js($user->name),
                                                email: @js($user->email),
                                                role: @js($user->role),
                                                status: @js($user->status)
                                            })"
                                            class="rounded-lg border border-[#D9D7CE] px-3 py-2 text-xs font-bold text-[#244B46] transition hover:border-[#244B46] hover:bg-[#DCE8E4]"
                                        >
                                            Edit
                                        </button>

                                        <!-- Delete button -->
                                        <button
                                            type="button"
                                            @click="openDelete({
                                                id: {{ $user->id }},
                                                name: @js($user->name),
                                                email: @js($user->email),
                                                role: @js($user->role),
                                                status: @js($user->status)
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
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <p class="font-semibold text-[#202A28]">
                                        No users found
                                    </p>
                                    <p class="mt-1 text-sm text-[#7A837D]">
                                        Add a user to get started.
                                    </p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="border-t border-[#EAE8E0] px-5 py-4">
                    {{ $users->links() }}
                </div>
            @endif

        </div>


        <!-- ================================= -->
        <!-- ADD USER MODAL                    -->
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
                            Add new user
                        </h2>
                        <p class="mt-1 text-sm text-[#7A837D]">
                            Create an account for an administrator or employee.
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

                <form action="{{ route('admin.store_user') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-4">

                        <!-- Name -->
                        <div>
                            <label for="add_name" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Full name
                            </label>
                            <input
                                type="text"
                                id="add_name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Enter full name"
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="add_email" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Email address
                            </label>
                            <input
                                type="email"
                                id="add_email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="example@email.com"
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role and Status -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <div>
                                <label for="add_role" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                    Role
                                </label>
                                <select
                                    id="add_role"
                                    name="role"
                                    required
                                    class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46]"
                                >
                                    <option value="employee" @selected(old('role', 'employee') === 'employee')>Employee</option>
                                    <option value="admin" @selected(old('role') === 'admin')>Administrator</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="add_status" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                    Status
                                </label>
                                <select
                                    id="add_status"
                                    name="status"
                                    required
                                    class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46]"
                                >
                                    <option value="active" @selected(old('status', 'active') === 'active')>Active</option>
                                    <option value="inactive" @selected(old('status') === 'inactive')>Inactive</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Password -->
                        <div>
                            <label for="add_password" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Password
                            </label>
                            <input
                                type="password"
                                id="add_password"
                                name="password"
                                required
                                minlength="8"
                                placeholder="Enter password"
                                autocomplete="new-password"
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#244B46] focus:ring-2 focus:ring-[#244B46]/10"
                            >
                            @error('password')
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
                            Create user
                        </button>
                    </div>
                </form>

            </div>
        </div>


        <!-- ================================= -->
        <!-- EDIT USER MODAL                   -->
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
                            Edit user
                        </h2>
                        <p class="mt-1 text-sm text-[#7A837D]">
                            Update account information.
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
                    :action="updateUrl.replace('__USER__', selectedUser.id)"
                    class="p-6"
                >
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">

                        <!-- Name -->
                        <div>
                            <label for="edit_name" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Full name
                            </label>
                            <input
                                type="text"
                                id="edit_name"
                                name="name"
                                x-model="selectedUser.name"
                                required
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46]"
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="edit_email" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                Email address
                            </label>
                            <input
                                type="email"
                                id="edit_email"
                                name="email"
                                x-model="selectedUser.email"
                                required
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46]"
                            >
                        </div>

                        <!-- Role and Status -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <div>
                                <label for="edit_role" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                    Role
                                </label>
                                <select
                                    id="edit_role"
                                    name="role"
                                    x-model="selectedUser.role"
                                    required
                                    class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46]"
                                >
                                    <option value="employee">Employee</option>
                                    <option value="admin">Administrator</option>
                                </select>
                            </div>

                            <div>
                                <label for="edit_status" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                    Status
                                </label>
                                <select
                                    id="edit_status"
                                    name="status"
                                    x-model="selectedUser.status"
                                    required
                                    class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46]"
                                >
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                        </div>

                        <!-- Password -->
                        <div>
                            <label for="edit_password" class="mb-2 block text-sm font-semibold text-[#202A28]">
                                New password
                                <span class="font-normal text-[#7A837D]">(optional)</span>
                            </label>
                            <input
                                type="password"
                                id="edit_password"
                                name="password"
                                minlength="8"
                                placeholder="Leave blank to keep current password"
                                autocomplete="new-password"
                                class="w-full rounded-xl border border-[#D9D7CE] bg-white px-4 py-3 text-sm outline-none focus:border-[#244B46]"
                            >
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
                    Delete user?
                </h2>

                <p class="mt-2 text-sm leading-6 text-[#59645F]">
                    Are you sure you want to delete
                    <strong x-text="selectedUser.name"></strong>?
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
                        :action="deleteUrl.replace('__USER__', selectedUser.id)"
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

