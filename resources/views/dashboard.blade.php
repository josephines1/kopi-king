<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                <div class="bg-white p-8">
                    <h3 class="font-bold text-2xl">Manage Website</h3>
                    <div class="py-2">
                        <div class="divider divider-start">
                            <h4 class="font-medium text-lg">Website Logo</h4>
                        </div>
                        <div class="card">
                            <div class="card-body flex gap-4 flex-row justify-between items-center p-4">
                                <div class="flex gap-4 items-center">
                                    <img src="{{ asset('storage/' . $logo['content']['company']['logo']) }}" alt="Logo" class="w-20 my-4">
                                    <p class="font-bold text-xl">{{ $logo['content']['company']['name'] }}</p>
                                </div>
                                <div class="card-actions justify-end">
                                    <a class="btn btn-ghost" href="{{ route('front-pages.edit', $logo) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                            <path d="M13.5 6.5l4 4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <div class="divider divider-start">
                            <h4 class="font-medium text-lg">Website Pages</h4>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($pages as $page)
                            <div class="card border-gray-600 border">
                                <div class="card-body flex flex-row justify-between items-center p-4">
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
                    </div>
                </div>
                <div class="bg-white p-8">
                    <h3 class="font-bold text-2xl mb-4">Latest Messages</h3>
                    <div class="overflow-x-auto mb-4">
                        <table class="table table-fixed">
                            <thead>
                                <tr>
                                    <th class="w-[2rem]">#</th>
                                    <th class="w-[6rem]">Name</th>
                                    <th class="w-[12rem]">Email</th>
                                    <th class="w-[12rem]">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 + (10 * ((request('page') ?? 1) - 1)) ?>
                                @forelse ($messages as $message)
                                <tr>
                                    <th>{{ $i++ }}</th>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->message }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No message found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <x-primary-button-link class="btn" href="{{ route('messages.index') }}">
                        {{ __('View More') }}
                    </x-primary-button-link>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPreview() {
            const imageInput = document.querySelector('#image');
            const imagePreview = document.querySelector('.image-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imageInput.files[0]);
            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
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