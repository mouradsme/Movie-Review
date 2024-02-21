<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies > Review > ') }} {{ $Movie->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <iframe width="100%" height="" style="height: 66vh;" src="{{$Movie->link}}&amp;controls=0" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<form method="POST" action="{{ route('movies.create.review.post') }}">
    @csrf
    <input type="hidden" name="movie_id" value="{{ $Movie->id }}" />
    <input type="hidden" name="user_id" value="{{ \Auth::id() }}" />
    <div class="space-y-12">

      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-6">
                {{ $Movie->description }}
            </div>

            @php
                $selected = $Review->rating?? 0;
            @endphp
          <div class="sm:col-span-3">
            <label for="rating" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Rating') }}</label>
            <div class="mt-2">
              <select name="rating" id="rating" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
                    <option value="0" @if ($selected == 0) selected @endif>{{ __('Terrible') }} 0/5</option>
                    <option value="1" @if ($selected == 1) selected @endif>{{ __('Awful') }} 1/5</option>
                    <option value="2" @if ($selected == 2) selected @endif>{{ __('Bad') }} 2/5</option>
                    <option value="3" @if ($selected == 3) selected @endif>{{ __('Average') }} 3/5</option>
                    <option value="4" @if ($selected == 4) selected @endif>{{ __('Good') }} 4/5</option>
                    <option value="5" @if ($selected == 5) selected @endif>{{ __('Excellent') }} 5/5</option>
              </select>
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="review" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Review') }}</label>
            <div class="mt-2">
              <textarea name="review" id="review" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">{{ __($Review->review??'Write your thoughts on the movie here...') }}</textarea>
            </div>
          </div>

          <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send</button>

        </div>
      </div>
      </div>
  </form>

         </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
        <h1 class="text-gray-900 font-bold text-xl mb-2">{{ __('Reviews') }}</h1>
    <ul class="bg-white rounded-lg shadow divide-y divide-gray-200 ">
        @foreach ($Reviews as $userReview)

        <li class="px-6 py-4">
            <div class="flex justify-between">
                <span class="font-semibold text-lg">{{$userReview->name}}</span>
                <span class="text-gray-500 text-xs">{{$userReview->Rating}}/5</span>
            </div>
            <p class="text-gray-700">{{$userReview->Review}}</p>
        </li>

        @endforeach
    </ul>
    </div>
</x-app-layout>
