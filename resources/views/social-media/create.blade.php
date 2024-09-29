<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <a href="{{ route('social-media.index') }}" class="hover:underline">Social Media</a> /
            <span class="font-semibold">{{ __('Create') }}</span>
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 bg-white mt-4 shadow-md rounded-md">
        <form method="POST" action="{{ route('social-media.store') }}" class="w-full" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input
                    name="name"
                    placeholder="{{ __('Instagram/Facebook/Others') }}"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    :value="old('name')"></x-text-input>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="url" :value="__('URL/Link')" />
                <x-text-input
                    name="url"
                    placeholder="{{ __('URL/Link') }}"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    :value="old('url')"></x-text-input>
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input
                    name="username"
                    placeholder="{{ __('username') }}"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    :value="old('username')"></x-text-input>
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="image" :value="__('Icon/Image')" />
                <div class="avatar my-4 block">
                    <div class="w-16 rounded-xl ring-gray-500 ring-offset-base-100 ring ring-offset-2">
                        <img class="image-preview bg-gray-200" />
                    </div>
                </div>
                <input type="file" name="image" id="image" class="file-input file-input-bordered file-input-md mt-1 w-full" onchange="showPreview()" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="buttons mt-8 flex justify-end gap-4">
                <x-secondary-button-link class="btn" href="{{ route('social-media.index') }}">{{ __('Cancel') }}</x-secondary-button-link>
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </form>
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
</x-app-layout>