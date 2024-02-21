<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies > All') }}
        </h2>

        @if ( json_decode(\Auth::user(), true)['role'] == 1 )
        <a href="/movies/create" class="mt-2 inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Create new') }}</a>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4">
                @foreach ($Movies as $Movie)
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full"  src="{{ $Movie->cover }}" alt="{{ $Movie->title }}">
                    <div>
                        <div class="container">
                            <div class="container__items">

                              <label for="st5" class="@if ($Movie->rating >= 5) checked @endif">
                                <div class="star-stroke">
                                  <div class="star-fill"></div>
                                </div>
                              </label>

                              <label for="st4" class="@if ($Movie->rating >= 4) checked @endif">
                                <div class="star-stroke">
                                  <div class="star-fill"></div>
                                </div>
                              </label>
                              <label for="st3"  class="@if ($Movie->rating >= 3) checked @endif">
                                <div class="star-stroke">
                                  <div class="star-fill"></div>
                                </div>
                              </label>
                              <label for="st2"  class="@if ($Movie->rating >= 2) checked @endif">
                                <div class="star-stroke">
                                  <div class="star-fill"></div>
                                </div>
                              </label>
                              <label for="st1" class="@if ($Movie->rating >= 1) checked @endif">
                                <div class="star-stroke">
                                  <div class="star-fill"></div>
                                </div>
                              </label>
                            </div>
                          </div>
                    </div>
                    <div class="px-6 py-4">
                      <div class="font-bold text-xl mb-2">{{ $Movie->title }}</div>
                      <div class="font-bold text-l mb-2">{{ $Movie->GenreName }}</div>
                      <div class="font-bold text-l mb-2">Rated: {{ $Movie->rating }}/5</div>

                    </div>
                        <div class="px-6 pt-4 pb-2">
                            @if ( json_decode(\Auth::user(), true)['role'] == 1 )
                            <a href="/movies/delete/{{ $Movie->id }}" class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Delete') }}</a>

                            @endif
                                <a href="{{ route('movies.create.review', ['id' => $Movie->id]) }}" class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 ml-2">{{ __('Review') }}</a>

                        </div>

                  </div>

                @endforeach


              </div>
         </div>
    </div>
</x-app-layout>
