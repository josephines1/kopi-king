<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <a href="{{ route('front-pages.index') }}" class="hover:underline">Front Pages</a> /
            <span class="font-semibold">{{ __('Edit') }}</span>
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 bg-white mt-4 shadow-md rounded-md">
        <form method="POST" action="{{ route('front-pages.update', $page) }}" enctype="multipart/form-data" class="divide-y divide-indigo-500">
            @csrf
            @method('patch')

            @if (isset($page->content['hero']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">Hero</h3>
                <div class="mb-4">
                    <x-input-label for="content.hero.title" :value="__('Title')" />
                    <x-text-input
                        name="content[hero][title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.hero.title', $page->content['hero']['title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.hero.title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.hero.text" :value="__('Text')" />
                    <textarea
                        name="content[hero][text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('content.hero.text', $page->content['hero']['text']) }}</textarea>
                    <x-input-error :messages="$errors->get('content.hero.text')" class="mt-2" />
                </div>

                <!-- Old Image (hidden) -->
                <input type="hidden" name="content[hero][oldImage]" value="{{ $page->content['hero']['image'] }}">

                <div class="mb-4">
                    <x-input-label for="image" :value="__('Hero Image')" />
                    <div class="avatar my-4 block">
                        <div class="w-16 rounded-xl ring-gray-500 ring-offset-base-100 ring ring-offset-2">
                            <img class="image-preview" src="{{ asset('storage/' . $page->content['hero']['image']) }}" />
                        </div>
                    </div>
                    <input type="file" name="content[hero][image]" id="image" class="file-input file-input-bordered file-input-md mt-1 w-full" onchange="showPreview()" />
                    <x-input-error :messages="$errors->get('content.hero.image')" class="mt-2" />
                </div>

                @if (isset($page->content['hero']['cta-text']))
                <div class="mb-4">
                    <x-input-label for="content.hero.cta-text" :value="__('Button Text')" />
                    <x-text-input
                        name="content[hero][cta-text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.hero.cta-text', $page->content['hero']['cta-text'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.hero.cta-text')" class="mt-2" />
                </div>
                @endif
                @if (isset($page->content['hero']['cta-link']))
                <div class="mb-4">
                    <x-input-label for="content.hero.cta-link" :value="__('Button Link')" />
                    <x-text-input
                        name="content[hero][cta-link]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.hero.cta-link', $page->content['hero']['cta-link'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.hero.cta-link')" class="mt-2" />
                </div>
                @endif
            </div>
            @endif

            @if (isset($page->content['about']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">About</h3>
                <div class="mb-4">
                    <x-input-label for="content.about.small-title" :value="__('Small Title')" />
                    <x-text-input
                        name="content[about][small-title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.about.small-title', $page->content['about']['small-title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.about.small-title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.about.title" :value="__('Title')" />
                    <x-text-input
                        name="content[about][title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.about.title', $page->content['about']['title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.about.title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.about.text" :value="__('Text')" />
                    <textarea
                        name="content[about][text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('content.about.text', $page->content['about']['text']) }}</textarea>
                    <x-input-error :messages="$errors->get('content.about.text')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.about.cta-text" :value="__('Button Text')" />
                    <x-text-input
                        name="content[about][cta-text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.about.cta-text', $page->content['about']['cta-text'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.about.cta-text')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.about.cta-link" :value="__('Button Link')" />
                    <x-text-input
                        name="content[about][cta-link]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.about.cta-link', $page->content['about']['cta-link'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.about.cta-link')" class="mt-2" />
                </div>
            </div>
            @endif

            @if (isset($page->content['product']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">Product</h3>
                <div class="mb-4">
                    <x-input-label for="content.product.small-title" :value="__('Small Title')" />
                    <x-text-input
                        name="content[product][small-title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.product.small-title', $page->content['product']['small-title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.product.small-title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.product.title" :value="__('Title')" />
                    <x-text-input
                        name="content[product][title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.product.title', $page->content['product']['title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.product.title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.product.cta-text" :value="__('Button Text')" />
                    <x-text-input
                        name="content[product][cta-text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.product.cta-text', $page->content['product']['cta-text'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.product.cta-text')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.product.cta-link" :value="__('Button Link')" />
                    <x-text-input
                        name="content[product][cta-link]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.product.cta-link', $page->content['product']['cta-link'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.product.cta-link')" class="mt-2" />
                </div>
            </div>
            @endif

            @if (isset($page->content['mission']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">Mission</h3>
                <div class="mb-4">
                    <x-input-label for="content.mission.small-title" :value="__('Small Title')" />
                    <x-text-input
                        name="content[mission][small-title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.mission.small-title', $page->content['mission']['small-title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.mission.small-title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.mission.title" :value="__('Title')" />
                    <x-text-input
                        name="content[mission][title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.mission.title', $page->content['mission']['title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.mission.title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.mission.text" :value="__('Text')" />
                    <textarea
                        name="content[mission][text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('content.mission.text', $page->content['mission']['text']) }}</textarea>
                    <x-input-error :messages="$errors->get('content.mission.text')" class="mt-2" />
                </div>
            </div>
            @endif

            @if (isset($page->content['vision']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">Vision</h3>
                <div class="mb-4">
                    <x-input-label for="content.vision.small-title" :value="__('Small Title')" />
                    <x-text-input
                        name="content[vision][small-title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.vision.small-title', $page->content['vision']['small-title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.vision.small-title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.vision.title" :value="__('Title')" />
                    <x-text-input
                        name="content[vision][title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.vision.title', $page->content['vision']['title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.vision.title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.vision.text" :value="__('Text')" />
                    <textarea
                        name="content[vision][text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('content.vision.text', $page->content['vision']['text']) }}</textarea>
                    <x-input-error :messages="$errors->get('content.vision.text')" class="mt-2" />
                </div>
            </div>
            @endif

            @if (isset($page->content['teams']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">Teams</h3>
                <div class="mb-4">
                    <x-input-label for="content.teams.small-title" :value="__('Small Title')" />
                    <x-text-input
                        name="content[teams][small-title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.teams.small-title', $page->content['teams']['small-title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.teams.small-title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.teams.title" :value="__('Title')" />
                    <x-text-input
                        name="content[teams][title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.teams.title', $page->content['teams']['title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.teams.title')" class="mt-2" />
                </div>
            </div>
            @endif

            @if (isset($page->content['location']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">Location</h3>
                <div class="mb-4">
                    <x-input-label for="content.location.small-title" :value="__('Small Title')" />
                    <x-text-input
                        name="content[location][small-title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.location.small-title', $page->content['location']['small-title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.location.small-title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.location.title" :value="__('Title')" />
                    <x-text-input
                        name="content[location][title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.location.title', $page->content['location']['title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.location.title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.location.text" :value="__('Text')" />
                    <textarea
                        name="content[location][text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('content.location.text', $page->content['location']['text']) }}</textarea>
                    <x-input-error :messages="$errors->get('content.location.text')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.location.cta-text" :value="__('Button Text')" />
                    <x-text-input
                        name="content[location][cta-text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.location.cta-text', $page->content['location']['cta-text'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.location.cta-text')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.location.cta-link" :value="__('Button Link')" />
                    <x-text-input
                        name="content[location][cta-link]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.location.cta-link', $page->content['location']['cta-link'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.location.cta-link')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.location.latitude" :value="__('Latitude')" />
                    <x-text-input
                        name="content[location][latitude]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.location.latitude', $page->content['location']['latitude'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.location.latitude')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.location.longitude" :value="__('Longitude')" />
                    <x-text-input
                        name="content[location][longitude]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.location.longitude', $page->content['location']['longitude'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.location.longitude')" class="mt-2" />
                </div>
            </div>
            @endif

            @if (isset($page->content['contact']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">Contact</h3>
                <div class="mb-4">
                    <x-input-label for="content.contact.small-title" :value="__('Small Title')" />
                    <x-text-input
                        name="content[contact][small-title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.contact.small-title', $page->content['contact']['small-title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.contact.small-title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.contact.title" :value="__('Title')" />
                    <x-text-input
                        name="content[contact][title]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.contact.title', $page->content['contact']['title'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.contact.title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="content.contact.text" :value="__('Text')" />
                    <textarea
                        name="content[contact][text]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('content.contact.text', $page->content['contact']['text']) }}</textarea>
                    <x-input-error :messages="$errors->get('content.contact.text')" class="mt-2" />
                </div>
            </div>
            @endif

            @if (isset($page->content['company']))
            <div class="my-4 py-4">
                <h3 class="text-2xl font-bold mb-2">Company Info</h3>

                <div class="mb-4">
                    <x-input-label for="content.company.name" :value="__('Name')" />
                    <x-text-input
                        name="content[company][name]"
                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        :value="old('content.company.name', $page->content['company']['name'])"></x-text-input>
                    <x-input-error :messages="$errors->get('content.company.name')" class="mt-2" />
                </div>

                <!-- Old Image (hidden) -->
                <input type="hidden" name="content[company][oldImage]" value="{{ $page->content['company']['logo'] }}">

                <div class="mb-4">
                    <x-input-label for="image" :value="__('Logo')" />
                    <div class="avatar my-4 block">
                        <div class="w-20 rounded-xl ring-gray-500 ring-offset-base-100 ring ring-offset-2">
                            <img class="image-preview" src="{{ asset('storage/' . $page->content['company']['logo']) }}" />
                        </div>
                    </div>
                    <input type="file" name="content[company][logo]" id="image" class="file-input file-input-bordered file-input-md mt-1 w-full" onchange="showPreview()" />
                    <x-input-error :messages="$errors->get('content.company.logo')" class="mt-2" />
                </div>
            </div>
            @endif

            <div class="buttons mt-8 flex justify-end gap-4 py-4">
                <x-secondary-button-link class="btn" href="{{ url()->previous() }}">{{ __('Cancel') }}</x-secondary-button-link>
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