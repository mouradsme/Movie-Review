<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Genres > Create New') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<form method="POST" action="{{ route('genres.create.post') }}">
    @csrf
    <div class="space-y-12">

      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-2">
            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Genre name') }}</label>
            <div class="mt-2">
              <input type="text" name="genre_name" id="genre_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
            </div>
          </div>
          <div class="sm:col-span-4">
            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Genre Description') }}</label>
            <div class="mt-2">
              <input type="text" name="description" id="description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
            </div>
          </div>

          <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>

        </div>
      </div>
      </div>
  </form>

         </div>
    </div>
</x-app-layout>
