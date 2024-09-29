<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl flex justify-between items-center">
            <h2 class="text-xl text-gray-800 leading-tight">
                <a href="{{ route('front-pages.index') }}" class="hover:underline hidden md:inline-block">Front Pages / Components / </a>
                <span class="font-semibold">{{ __('Teams') }}</span>
            </h2>
            <x-primary-button-link href="{{ route('teams.create') }}" class="btn">New Member</x-primary-button-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white">
            <div class="overflow-x-auto">
                <table class="table table-fixed">
                    <thead>
                        <tr>
                            <th class="w-[2rem]">#</th>
                            <th class="w-[8rem] md:w-auto">Image</th>
                            <th class="w-[8rem] md:w-auto">Name</th>
                            <th class="w-[8rem] md:w-auto">Job Title</th>
                            <th class="w-[8rem] md:w-auto">Desc</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @forelse ($teams as $team)
                        <tr>
                            <th>{{ $i++ }}</th>
                            <td>
                                <div class="avatar">
                                    <div class="w-16 rounded-xl">
                                        <img src="{{ asset('storage/' . $team->image) }}" />
                                    </div>
                                </div>
                            </td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->title }}</td>
                            <td>{{ $team->desc }}</td>
                            <td>
                                <div class="space-x-2 flex flex-nowrap">
                                    <x-secondary-button-link class="btn" href="{{ route('teams.edit', $team) }}">
                                        {{ __('Edit') }}
                                    </x-secondary-button-link>
                                    <x-danger-ghost-button class="btn bg-transparent font-bold text-red-500"
                                        onclick="showDeleteModal('{{ e($team->slug) }}', '{{ e($team->name) }}')">
                                        {{ __('Delete') }}
                                    </x-danger-ghost-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No team member found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Modal - Start -->
    <dialog id="deleteTeamMember" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Delete?</h3>
            <p class="py-4">Are you sure want to remove <strong id="modal-name" class="text-red-600">this</strong> as team member?</p>
            <div class="modal-action">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('delete')
                    <div class="buttons mt-8 flex justify-end gap-4">
                        <x-secondary-button class="btn" onclick="document.getElementById('deleteTeamMember').close();">{{ __('Cancel') }}</x-secondary-button>
                        <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function showDeleteModal(teamMemberSlug, teamMemberName) {
            const form = document.getElementById('deleteForm');
            form.action = `/teams/${teamMemberSlug}`;

            const modalName = document.getElementById('modal-name');
            modalName.textContent = teamMemberName;

            document.getElementById('deleteTeamMember').showModal();
        }
    </script>
    <!-- Delete Modal - End -->

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