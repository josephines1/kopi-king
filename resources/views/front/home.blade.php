<x-front-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Hero -->
        <section id="hero">
            <div class="hero bg-white lg:min-h-screen rounded-xl p-2 md:p-4">
                <div class="hero-content flex-col lg:flex-row-reverse gap-4">
                    <img
                        src="{{ asset('storage/' . $content['hero']['image']) }}"
                        class="max-w-sm rounded-lg shadow-xl flex-1 w-full h-full object-cover" />
                    <div class="flex-1">
                        <h1 class="text-5xl font-bold">{{ $content['hero']['title'] }}</h1>
                        <p class="py-6 opacity-70">
                            {{ $content['hero']['text'] }}
                        </p>
                        <x-primary-button-link href="{{ $content['hero']['cta-link'] }}" class="btn">{{ $content['hero']['cta-text'] }}</x-primary-button-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- About -->
        <section id="about" class="py-20">
            <div class="divider divider-start">{{ $content['about']['small-title'] }}</div>
            <h2 class="text-7xl font-bold mb-4">{{ $content['about']['title'] }}</h2>
            <p class="opacity-70 mb-8 w-full md:w-2/3">{{ $content['about']['text'] }}</p>
            <x-secondary-button-link href="{{ $content['about']['cta-link'] }}" class="btn">{{ $content['about']['cta-text'] }}</x-secondary-button-link>
        </section>

        <!-- Menu -->
        <section id="menu" class="py-20">
            <div class="divider divider-center">{{ $content['product']['small-title'] }}</div>
            <h2 class="text-5xl font-bold mb-4 text-center">{{ $content['product']['title'] }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-10 mb-16">
                @foreach($menus as $menu)
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
                @endforeach
            </div>

            <div class="flex justify-center">
                <x-secondary-button-link href="{{ $content['product']['cta-link'] }}" class="btn">{{ $content['product']['cta-text'] }}</x-secondary-button-link>
            </div>
        </section>

        <!-- Contact -->
        <section id="contact" class="py-20">
            <div class="divider divider-center">{{ $content['contact']['small-title'] }}</div>
            <h2 class="text-5xl font-bold mb-4 text-center">{{ $content['contact']['title'] }}</h2>
            <p class="opacity-70 mb-8 w-full md:w-2/3 text-center mx-auto">{{ $content['contact']['text'] }}</p>

            <div class="md:w-2/3 mx-auto">
                <form method="POST" action="{{ route('messages.store') }}" class="w-full">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input
                            name="name"
                            placeholder="{{ __('What\'s your name?') }}"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            :value="old('name')"></x-text-input>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input
                            name="email"
                            placeholder="{{ __('What\'s your email?') }}"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            :value="old('email')"></x-text-input>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" :value="__('Phone Number (Optional)')" />
                        <x-text-input
                            name="phone"
                            placeholder="{{ __('What\'s your phone number? (Optional)') }}"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            :value="old('phone')"></x-text-input>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="message" :value="__('Text')" />
                        <textarea
                            name="message"
                            class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            placeholder="What do you want to convey?">{{ old('message', '') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <div class="buttons mt-8 flex justify-center gap-4">
                        <x-primary-button class="btn">{{ __('Send') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    @if ($errors->any())
    <script>
        window.location.hash = '#contact';
    </script>
    @endif

    <!-- Sweet Alert - Start -->
    @if(session()->has('success'))
    <script>
        Swal.fire({
            title: "Thank You!",
            text: "{{ session()->get('success') }}",
            icon: "success"
        });
    </script>
    @endif
    <!-- Sweet Alert - End -->
</x-front-layout>