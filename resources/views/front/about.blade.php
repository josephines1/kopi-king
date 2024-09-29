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

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Mission & Vision -->
        <section id="mission_vision" class="pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="mission">
                    <div class="divider">{{ $content['mission']['small-title'] }}</div>
                    <h2 class="text-2xl font-bold text-center mb-4">{{ $content['mission']['title'] }}</h2>
                    <p class="opacity-70 text-center">{{ $content['mission']['text'] }}</p>
                </div>
                <div class="vision">
                    <div class="divider">{{ $content['vision']['small-title'] }}</div>
                    <h2 class="text-2xl font-bold text-center mb-4">{{ $content['vision']['title'] }}</h2>
                    <p class="opacity-70 text-center">{{ $content['vision']['text'] }}</p>
                </div>
            </div>
        </section>


        <!-- Team -->
        <section id="team" class="pb-20">
            <div class="divider">{{ $content['teams']['small-title'] }}</div>
            <h2 class="text-2xl font-bold text-center mb-4">{{ $content['teams']['title'] }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 sm:p-6 lg:p-8 md:px-4">
                @foreach($teams as $team)
                <div class="rounded-md shadow-md flex flex-col bg-white p-4">
                    <div class="avatar mx-auto mb-4">
                        <div class="w-32 rounded-full">
                            <img src="{{ asset('storage/' . $team->image) }}" />
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-center">{{ $team->name }}</h3>
                    <p class="opacity-70 text-center text-sm mb-2">{{ $team->title }}</p>
                    <p class="opacity-70 text-center italic">{{ $team->desc }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Contact -->
        <section id="contact" class="pb-20">
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