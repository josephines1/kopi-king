<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Users') }}
            </h2>
            <x-primary-button-link href="{{ route('users.create') }}" class="btn">New User</x-primary-button-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white">
            <div class="overflow-x-auto">
                <table class="table table-fixed">
                    <thead>
                        <tr>
                            <th class="w-[2rem]">#</th>
                            <th class="w-[8rem] md:w-auto">Name</th>
                            <th class="w-[8rem] md:w-auto">Email</th>
                            <th class="w-[8rem] md:w-auto">Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @forelse ($users as $user)
                        <tr>
                            <th>{{ $i++ }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format("M d, Y") }}</td>
                            <td>
                                <div class="space-x-2 flex flex-nowrap">
                                    <x-secondary-button-link class="btn" href="{{ route('users.edit', $user) }}">
                                        {{ __('Edit') }}
                                    </x-secondary-button-link>
                                    <x-primary-ghost-button class="btn bg-transparent font-bold text-indigo-500" onclick="showResetModal('{{ $user->username }}', '{{ $user->name }}')">
                                        {{ __('Reset') }}
                                    </x-primary-ghost-button>
                                    <x-danger-ghost-button class="btn bg-transparent font-bold text-red-500"
                                        onclick="showDeleteModal('{{ $user->username }}', '{{ $user->name }}')">
                                        {{ __('Delete') }}
                                    </x-danger-ghost-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No user found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal - Start -->
    <dialog id="resetUser" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Reset Password?</h3>
            <p class="py-4">Are you sure want to reset <strong id="modal-name" class="text-red-600">this</strong>'s password?</p>
            <div class="modal-action">
                <form id="resetForm" method="POST">
                    @csrf
                    <div class="buttons mt-8 flex justify-end gap-4">
                        <x-secondary-button class="btn" onclick="document.getElementById('resetUser').close();">{{ __('Cancel') }}</x-secondary-button>
                        <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Reset') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <!-- Delete Modal - Start -->
    <dialog id="deleteUser" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Delete?</h3>
            <p class="py-4">Are you sure want to delete <strong id="modal-name" class="text-red-600">this</strong> user?</p>
            <div class="modal-action">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('delete')
                    <div class="buttons mt-8 flex justify-end gap-4">
                        <x-secondary-button class="btn" onclick="document.getElementById('deleteUser').close();">{{ __('Cancel') }}</x-secondary-button>
                        <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
    <!-- Delete Modal - End -->

    <script>
        function showDeleteModal(userUsername, userName) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/users/${userUsername}`;

            const modalName = document.getElementById('modal-name');
            modalName.textContent = userName;

            document.getElementById('deleteUser').showModal();
        }

        function showResetModal(userUsername, userName) {
            const form = document.getElementById('resetForm');
            form.action = `users/${userUsername}/reset-password`;

            const modalName = document.getElementById('modal-name');
            modalName.textContent = userName;

            document.getElementById('resetUser').showModal();
        }
    </script>

    <!-- Sweet Alert - Start -->
    @if(session()->has('success'))
    <script>
        Swal.fire({
            title: "{{ session()->get('success') }}",
            icon: "success"
        });
    </script>
    @endif
    <!-- Sweet Alert - End -->

</x-app-layout>