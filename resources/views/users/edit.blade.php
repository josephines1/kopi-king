<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <a href="{{ route('users.index') }}" class="hover:underline">Admin Users</a> /
            <span class="font-semibold">{{ __('Edit') }}</span>
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 bg-white mt-4 shadow-md rounded-md">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input
                    name="name"
                    class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    :value="old('name', $user->name)"></x-text-input>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input
                    name="email"
                    class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    :value="old('email', $user->email)"></x-text-input>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="buttons mt-8 flex justify-end gap-4">
                <x-secondary-button-link class="btn" href="{{ route('users.index') }}">{{ __('Cancel') }}</x-secondary-button-link>
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>