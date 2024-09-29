<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <a href="{{ route('menus.index') }}" class="hover:underline">Menus</a> /
            <span class="font-semibold">{{ __('Edit') }}</span>
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 bg-white mt-4 shadow-md rounded-md">
        <form method="POST" action="{{ route('menus.update', $menu) }}" class="w-full" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input
                    name="name"
                    placeholder="{{ __('Name') }}"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    :value="old('name', $menu->name)"></x-text-input>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="desc" :value="__('Description')" />
                <x-text-input
                    name="desc"
                    placeholder="{{ __('Description') }}"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    :value="old('desc', $menu->desc)"></x-text-input>
                <x-input-error :messages="$errors->get('desc')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="category_id" :value="__('Category')" />
                <select class="select mt-1 select-bordered border-gray-300 w-full" name="category_id">
                    <option disabled selected>Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input
                    name="price"
                    type="number"
                    placeholder="{{ __('Price') }}"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    :value="old('price', $menu->price)"></x-text-input>
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <!-- Old Image -->
            <input type="hidden" name="oldImage" value="{{ $menu->image }}">

            <div class="mb-4">
                <x-input-label for="image" :value="__('Image')" />
                <div class="avatar my-4 block">
                    <div class="w-[8rem] rounded-xl ring-gray-500 ring-offset-base-100 ring ring-offset-2">
                        <img src="{{ asset('storage/' . $menu->image) }}" class="image-preview" />
                    </div>
                </div>
                <input type="file" name="image" id="image" class="file-input file-input-bordered file-input-md mt-1 w-full" onchange="showPreview()" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="buttons mt-8 flex justify-end gap-4">
                <x-secondary-button-link class="btn" href="{{ route('menus.index') }}">{{ __('Cancel') }}</x-secondary-button-link>
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