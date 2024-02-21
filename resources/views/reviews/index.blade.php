<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Reviews') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4">
                @foreach ($Users as $User)
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                      <p class="text-gray-700 text-base">{{ $User->name }}</p>
                      <p class="text-gray-700 text-base">{{ $User->created_at }}</p>
                    </div>


                    @if ( json_decode(\Auth::user(),true)['role'] == 1 )
                        <div class="px-6 pt-4 pb-2">
                        <a href="/reviews/user/{{ $User->id }}" class="inline-block bg-green-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Review') }}</a>
                        </div>

                    @endif

                </div>
                @endforeach

              </div>

              @if ( json_decode(\Auth::user(), true)['role'] == 2 )
              <button type="submit" class="mt-2 inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Submit Answers') }}</button>
              @endif
         </div>
    </div>
</x-app-layout>
