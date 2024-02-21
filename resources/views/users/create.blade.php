
@if (json_decode(\Auth::user(), true)['id'] == 1)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users > Create New Moderator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<form method="POST" action="{{ route('moderators.create.post') }}">
    @csrf
    <div class="space-y-12">

      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-2">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Full name') }}</label>
            <div class="mt-2">
              <input type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
            </div>
          </div>
          <div class="sm:col-span-4">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Email') }}</label>
            <div class="mt-2">
              <input type="text" name="email" id="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Password') }}</label>
            <div class="mt-2">
              <input type="text" name="password" id="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
            </div>
          </div>

          <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>

        </div>
      </div>
      </div>
  </form>

         </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
        <h1 class="text-gray-900 font-bold text-xl mb-2">{{ __('Moderators') }}</h1>
    <ul class="bg-white rounded-lg shadow divide-y divide-gray-200 ">
        @foreach ($Mods as $Mod)

        <li class="px-6 py-4">
            <div class="flex justify-between">
                <span class="font-semibold text-lg">{{$Mod->name}}</span>
                <span class="text-gray-500 text-xs">{{$Mod->created_at}}/5</span>
            </div>
            <p class="text-gray-700">{{$Mod->email}}</p>
        </li>

        @endforeach
    </ul>
    </div>
</x-app-layout>

@else
Unauthorized
@endif
