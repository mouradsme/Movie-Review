<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>You've logged in sucessfully!</p>
                    <p>If you already took the test, then you can choose a movie from the <a class="text-blue-500" href='{{ route('movies') }}'>Movies List</a> </p>
                    <p>If you haven't taken the test yet. <a class="text-blue-500" href='{{ route('test.index') }}'>Click here</a>. </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
