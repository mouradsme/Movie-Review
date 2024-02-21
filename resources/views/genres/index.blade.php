<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Genres > All') }}
        </h2>

        @if ( json_decode(\Auth::user(), true)['role'] == 1 )
        <a href="/genres/create" class="mt-2 inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Create new') }}</a>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4">
                @foreach ($Genres as $Genre)
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                      <div class="font-bold text-xl mb-2">{{ $Genre->name }}</div>
                      <p class="text-gray-700 text-base">{{ $Genre->description }}</p>
                    </div>
                    @if ( json_decode(\Auth::user(), true)['role'] == 1 )
                    <div class="px-6 pt-4 pb-2">
                        <a href="/genres/delete/{{ $Genre->id }}" class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Delete') }}</a>
                        </div>

                    @endif
                  </div>

                @endforeach


              </div>
         </div>
    </div>
</x-app-layout>
