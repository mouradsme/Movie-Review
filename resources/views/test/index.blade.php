<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Test Questions') }}
        </h2>

        @if ( json_decode(\Auth::user(), true)['role'] == 1 )
        <a href="/test/create" class="mt-2 inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Create new question') }}</a>
        @endif
    </x-slot>
    <form method="POST" action="{{ route('answers.post') }}">
        @csrf
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                @foreach ($TestQuestions as $Question)
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                      <div class="font-bold text-xl mb-2">{{ $Question->title }}</div>
                      <p class="text-gray-700 text-base">{{ $Question->question }}</p>
                    </div>
                    @php
                        $Answers = preg_split('/,/', $Question->choices);
                    @endphp
                    @if (count($Answers) > 1)
                    <select required name="answers[{{$Question->id}}]" class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-gray-700 ml-2 mb-2">
                        @foreach ($Answers as $Answer)
                            <option value="{{ $Answer }}">{{$Answer}}</option>
                        @endforeach
                    </select>
                    @else
                    <textarea name="answers[{{$Question->id}}]" required class="mr-2 ml-1 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3"></textarea>
                    @endif
                    @if ( json_decode(\Auth::user(), true)['role'] == 1 )
                    <div class="px-6 pt-4 pb-2">
                        <a href="/test/delete/{{ $Question->id }}" class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ __('Delete') }}</a>
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

</form>
</x-app-layout>
