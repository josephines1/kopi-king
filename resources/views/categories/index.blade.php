<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <x-primary-button-link href="{{ route('categories.create') }}" class="btn">New Category</x-primary-button-link>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @forelse ($categories as $category)
                        <tr>
                            <th>{{ $i++ }}</th>
                            <td>
                                <a class="text-blue-600 hover:underline flex items-center" href="{{ route('menus.index') . '?category=' . $category->slug }}">
                                    <span>{{ $category->name }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-up-right">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M17 7l-10 10" />
                                        <path d="M8 7l9 0l0 9" />
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <div class="space-x-2 flex flex-nowrap">
                                    <x-secondary-button-link class="btn" href="{{ route('categories.edit', $category) }}">
                                        {{ __('Edit') }}
                                    </x-secondary-button-link>
                                    <x-danger-ghost-button class="btn bg-transparent font-bold text-red-500"
                                        onclick="showDeleteModal('{{ $category->slug }}', '{{ $category->name }}')">
                                        {{ __('Delete') }}
                                    </x-danger-ghost-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No category found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Modal - Start -->
    <dialog id="deleteCategory" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Delete?</h3>
            <p class="py-4">Are you sure want to delete <strong id="modal-name" class="text-red-600">this</strong> category?</p>
            <div class="modal-action">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('delete')
                    <div class="buttons mt-8 flex justify-end gap-4">
                        <x-secondary-button class="btn" onclick="document.getElementById('deleteCategory').close();">{{ __('Cancel') }}</x-secondary-button>
                        <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function showDeleteModal(categorySlug, categoryName) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/categories/${categorySlug}`;

            const modalName = document.getElementById('modal-name');
            modalName.textContent = categoryName;

            document.getElementById('deleteCategory').showModal();
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