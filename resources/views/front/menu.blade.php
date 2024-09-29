<x-front-layout>
    <!-- Hero -->
    <div
        class="hero min-h-[50vh]"
        style="background-image: url({{ asset('storage/' . $content['hero']['image']) }});">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="max-w-7xl mx-auto hero-content text-white text-center">
            <div class="max-w-lg">
                <h1 class="mb-5 text-5xl font-bold">{{ $content['hero']['title'] }}</h1>
                <p class="mb-5 opacity-70">
                    {{$content['hero']['text']}}
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto pb-4">
        <!-- Categories -->
        <div class="flex flex-row sticky md:static top-0 left-0 right-0 p-4 sm:p-6 lg:p-8 md:px-4 py-6 gap-4 z-40 bg-gray-100 overflow-x-auto no-scrollbar">
            <span class="badge cursor-pointer p-4 badge-lg active bg-indigo-500 text-white" data-category-id="all">All Category</span>
            @foreach ($categories as $category)
            <span class="badge cursor-pointer p-4 badge-lg bg-indigo-100" data-category-id="{{ $category->id }}">{{ $category->name }}</span>
            @endforeach
        </div>

        <!-- Menu List -->
        <section id="menu_list">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4 sm:p-6 lg:p-8 md:px-4" id="menu-list">
                @forelse($menus as $menu)
                <div class="card bg-base-100 shadow-xl">
                    <figure>
                        @if($menu->image)
                        <img class="w-full object-cover h-[250px]" src="{{ asset('storage/' . $menu->image) }}" />
                        @else
                        <img class="w-full object-cover h-[250px]" src="{{ asset('storage/' . 'menu-images/default.png') }}" />
                        @endif
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">
                            {{ $menu->name }}
                        </h2>
                        <p>{{ number_format($menu->price, 2) }}</p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-outline">{{ $menu->category->name }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <p>We're sorry... We can't find the menu you want...</p>
                @endforelse
            </div>
        </section>
    </div>

    <script>
        document.querySelectorAll('.badge').forEach(badge => {
            badge.addEventListener('click', function() {
                let categoryId = this.getAttribute('data-category-id');
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Remove Selected Category Class
                document.querySelectorAll('.badge').forEach(badge => {
                    badge.classList.remove('bg-indigo-500', 'text-white');
                    badge.classList.add('bg-indigo-100');
                });

                // Set Selected Category Class
                this.classList.remove('bg-indigo-100');
                this.classList.add('bg-indigo-500', 'text-white');

                fetch('/menu/filter', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            category_id: categoryId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        let menuList = document.getElementById('menu-list');
                        menuList.innerHTML = '';

                        // Render card menu yang difilter
                        data.menus.forEach(menu => {
                            menuList.innerHTML += `
                        <div class="card bg-base-100 shadow-xl">
                            <figure>
                                ${menu.image ? 
                                    `<img class="w-full object-cover h-[250px]" src="/storage/${menu.image}" />`
                                    :
                                    `<img class="w-full object-cover h-[250px]" src="/storage/menu-images/default.png" />`
                                }
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title">${menu.name}</h2>
                                <p>${parseFloat(menu.price).toFixed(2)}</p>
                                <div class="card-actions justify-end">
                                    <div class="badge badge-outline">${menu.category.name}</div>
                                </div>
                            </div>
                        </div>
                    `;
                        });
                    });
            });
        });
    </script>
</x-front-layout>