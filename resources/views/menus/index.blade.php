<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Menus') }}
            </h2>
            <x-primary-button-link href="{{ route('menus.create') }}" class="btn">New Menu</x-primary-button-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-4 mx-auto">
            <form action="" method="get">
                <div class="join w-full justify-center">
                    <div>
                        <div>
                            <input type="search" class="input input-bordered join-item w-[100px] md:w-96" placeholder="Search" name="search" value="{{ request('search') }}" />
                        </div>
                    </div>
                    <select class="select select-bordered join-item" name="category">
                        <option value="" selected>All Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="indicator">
                        <button class="btn join-item bg-indigo-500 text-white hover:bg-indigo-400">Search</button>
                    </div>
                </div>
            </form>
            @if(request('search') || request('category'))
            <a href="{{ route('menus.index') }}" class="text-blue-500 hover:underline text-sm mt-2 flex items-center justify-center">
                <span> clear filter </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-rotate-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15 4.55a8 8 0 0 0 -6 14.9m0 -4.45v5h-5" />
                    <path d="M18.37 7.16l0 .01" />
                    <path d="M13 19.94l0 .01" />
                    <path d="M16.84 18.37l0 .01" />
                    <path d="M19.37 15.1l0 .01" />
                    <path d="M19.94 11l0 .01" />
                </svg>
            </a>
            @endif
        </div>

        <div class="mt-6 bg-white">
            <div class="overflow-x-auto">
                <table class="table table-fixed">
                    <thead>
                        <tr>
                            <th class="w-[2rem]">#</th>
                            <th class="w-[8rem] md:w-auto">Image</th>
                            <th class="w-[8rem] md:w-auto">Name</th>
                            <th class="w-[8rem] md:w-auto">Category</th>
                            <th class="w-[8rem] md:w-auto">Description</th>
                            <th class="w-[8rem] md:w-auto">Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (10 * ((request('page') ?? 1) - 1)) ?>
                        @forelse ($menus as $menu)
                        <tr>
                            <th>{{ $i++ }}</th>
                            <td>
                                <div class="avatar">
                                    <div class="w-16 rounded-xl">
                                        @if($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" />
                                        @else
                                        <img src="{{ asset('storage/' . 'menu-images/default.png') }}" />
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->category->name }}</td>
                            <td>{{ $menu->desc }}</td>
                            <td>{{ number_format($menu->price, 2) }}</td>
                            <td>
                                <div class="space-x-2 flex flex-nowrap">
                                    <x-secondary-button-link class="btn" href="{{ route('menus.edit', $menu) }}">
                                        {{ __('Edit') }}
                                    </x-secondary-button-link>
                                    <x-danger-ghost-button class="btn bg-transparent font-bold text-red-500"
                                        onclick="showDeleteModal('{{ $menu->slug }}', '{{ $menu->name }}')">
                                        {{ __('Delete') }}
                                    </x-danger-ghost-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No menu found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{ $menus->links() }}
        </div>
    </div>


    <!-- Delete Modal - Start -->
    <dialog id="deleteMenu" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Delete?</h3>
            <p class="py-4">Are you sure want to delete <strong id="modal-name" class="text-red-600">this</strong> menu?</p>
            <div class="modal-action">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('delete')
                    <div class="buttons mt-8 flex justify-end gap-4">
                        <x-secondary-button class="btn" onclick="document.getElementById('deleteMenu').close();">{{ __('Cancel') }}</x-secondary-button>
                        <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function showDeleteModal(menuSlug, menuName) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/menus/${menuSlug}`;

            const modalName = document.getElementById('modal-name');
            modalName.textContent = menuName;

            document.getElementById('deleteMenu').showModal();
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