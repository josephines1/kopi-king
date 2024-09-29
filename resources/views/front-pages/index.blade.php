<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Front Pages') }}
            </h2>
            <x-primary-button-link href="/" class="btn">View Website</x-primary-button-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="divider divider-start text-2xl font-bold mb-8">Pages</div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-12">
            @foreach($pages as $page)
            <div class="card bg-base-100 shadow-md">
                <div class="card-body flex flex-row justify-between items-center">
                    <div>
                        <h2 class="card-title">{{ $page->name }}</h2>
                        <p class="text-sm opacity-70">Last updated on: {{ $page->updated_at->diffForHumans() }}</p>
                    </div>
                    <div class="card-actions justify-end">
                        <a class="btn btn-ghost" href="{{ route('front-pages.edit', $page) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                <path d="M13.5 6.5l4 4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="divider divider-start text-2xl font-bold mb-8">Components</div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-12">
            <!-- social media -->
            <div class="card bg-base-100 shadow-md">
                <div class="card-body flex flex-row justify-between items-center">
                    <div>
                        <h2 class="card-title">Social Media</h2>
                    </div>
                    <div class="card-actions justify-end">
                        <a class="btn btn-ghost" href="{{ route('social-media.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-up-right text-indigo-500">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 7l-10 10" />
                                <path d="M8 7l9 0l0 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- teams -->
            <div class="card bg-base-100 shadow-md">
                <div class="card-body flex flex-row justify-between items-center">
                    <div>
                        <h2 class="card-title">Teams Member</h2>
                    </div>
                    <div class="card-actions justify-end">
                        <a class="btn btn-ghost" href="{{ route('teams.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-up-right text-indigo-500">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 7l-10 10" />
                                <path d="M8 7l9 0l0 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- product -> menu -->
            <div class="card bg-base-100 shadow-md">
                <div class="card-body flex flex-row justify-between items-center">
                    <div>
                        <h2 class="card-title">Product (Menu)</h2>
                    </div>
                    <div class="card-actions justify-end">
                        <a class="btn btn-ghost" href="{{ route('menus.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-up-right text-indigo-500">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 7l-10 10" />
                                <path d="M8 7l9 0l0 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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