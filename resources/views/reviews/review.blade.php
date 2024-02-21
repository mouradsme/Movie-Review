<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Test Answers by ') }} {{ $User->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                @foreach ($Answers as $Answer)
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                      <div class="font-bold text-l mb-2">{{ $Answer->qTitle }}</div>
                      <div class=" text-l mb-2">{{ $Answer->question }}</div>
                      <div class="font-bold text-xl mb-2">{{ $Answer->answer }}</div>

                    </div>


                </div>
                @endforeach
              </div>

              @if ( json_decode(\Auth::user(), true)['role'] == 1 )
                <div class="px-6 pt-4 pb-2">
                <a href="/reviews/accept/{{ $User->id }}" class="inline-block bg-green-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Accept') }}</a>
                <a href="/reviews/refuse/{{ $User->id }}" class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Refuse') }}</a>
                </div>
              @endif
         </div>
    </div>

</x-app-layout>
