<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Messages') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white">
            <div class="overflow-x-auto">
                <table class="table table-fixed">
                    <thead>
                        <tr>
                            <th class="w-[2rem]">#</th>
                            <th class="w-[8rem] md:w-auto">Name</th>
                            <th class="w-[8rem] md:w-auto">Email</th>
                            <th class="w-[8rem] md:w-auto">Phone Number</th>
                            <th class="w-[12rem] md:w-auto">Message</th>
                            <th class="w-[8rem] md:w-auto">Sent at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (10 * ((request('page') ?? 1) - 1)) ?>
                        @forelse ($messages as $message)
                        <tr>
                            <th>{{ $i++ }}</th>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->phone }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->created_at->format("M d, Y") }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No message found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>