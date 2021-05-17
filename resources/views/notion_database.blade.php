@php

use Carbon\Carbon;

@endphp

@extends('app')

@section('content')
    <a href="{{ url()->previous() }}">Back</a>
    <h1 class="text-2xl">📚 {{ $database->getTitle() }}</h1>

    <table>

        <thead>
            <tr>
                @foreach (collect(array_keys($database->getRawProperties()))->reverse()->all() as $property)

                <th class="p-2 text-left border-b-2 border-gray-400">{{ $property }}</th>

                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
                <tr class="group">
                    @foreach (collect(array_keys($database->getRawProperties()))->reverse()->all() as $property)
                    <td class="group-hover:bg-indigo-100 duration-200 relative p-2 border-t @if (!$loop->first) border-l @endif border-gray-300">
                        @if ($entry->getProperty($property) != null && $entry->getProperty($property)->getType() == 'title')
                            {{ $entry->getTitle() }}<a
                                class="absolute top-0 right-0 px-2 py-1 mt-1 mr-2 text-sm duration-200 transform scale-95 bg-gray-200 border border-gray-400 rounded opacity-0 cursor-pointer hover:scale-100 group-hover:opacity-100 hover:bg-white"
                                onclick="openPage('/notion/page/{{ $entry->getId() }}');">📑 Open</a>
                        @elseif ($entry->getProperty($property) != null &&
                            is_array($entry->getProperty($property)->getRawContent()))
                            {{ json_encode($entry->getProperty($property)->getRawContent()) }}
                        @elseif($entry->getProperty($property) != null)
                            @if ($carbon = new Carbon($entry->getProperty($property)->getRawContent()))
                                {{ $carbon }}
                            @else
                                {{ $entry->getProperty($property)->getRawContent() }}
                            @endif
                        @else
                        @endif
                    </td>
            @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="page_modal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
          <!--
            Background overlay, show/hide based on modal state.

            Entering: "ease-out duration-300"
              From: "opacity-0"
              To: "opacity-100"
            Leaving: "ease-in duration-200"
              From: "opacity-100"
              To: "opacity-0"
          -->
          <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>

          <!-- This element is to trick the browser into centering the modal contents. -->
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

          <!--
            Modal panel, show/hide based on modal state.

            Entering: "ease-out duration-300"
              From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              To: "opacity-100 translate-y-0 sm:scale-100"
            Leaving: "ease-in duration-200"
              From: "opacity-100 translate-y-0 sm:scale-100"
              To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          -->
          <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full sm:p-6" style="height:800px;">
            <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                <button type="button" onclick="closePage();" class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <span class="sr-only">Close</span>
                  <!-- Heroicon name: outline/x -->
                  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
              <div id="page_modal_loading" class="flex items-center justify-center w-full h-full text-xl">
                Loading...
            </div>
            <iframe id="page_modal_iframe" class="w-full h-full" src="/notion/page/36fc84c3-a6cd-4bf8-8387-7558a5f08147" onload="document.getElementById('page_modal_loading').classList.add('hidden');"></iframe>
          </div>
        </div>
      </div>

    <script>
        function openPage(url){
            document.getElementById('page_modal').classList.add('visible');
            document.getElementById('page_modal_loading').classList.remove('hidden');
            document.getElementById('page_modal').classList.remove('hidden');
            document.getElementById('page_modal_iframe').setAttribute('src', url);

        }
        function closePage(){
            document.getElementById('page_modal').classList.add('hidden');
            document.getElementById('page_modal').classList.remove('visible');
            document.getElementById('page_modal_iframe').setAttribute('src', "");
        }
    </script>

@endsection
