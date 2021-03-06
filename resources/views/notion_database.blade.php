@php

use Carbon\Carbon;

@endphp

@extends('app')

@section('content')
    <a class="inline-block gap-2 px-2 py-1 mb-2 duration-300 transform bg-gray-200 border border-transparent rounded hover:-translate-x-1 hover:bg-gray-300 hover:border-gray-600"
        href="/notion">
        <span class="flex gap-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
            </svg> Back</span>
    </a>

    <h1 class="mb-2 text-2xl">📚 {{ $database->getTitle() }}</h1>

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
                        @elseif ($entry->getProperty($property) != null)
                            <x-notion-property :property="$entry->getProperty($property)" :showPropertyName="false" />
                        @endif
                    </td>
            @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="page_modal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full sm:p-6"
                style="height:800px;">
                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                    <button type="button" onclick="closePage();"
                        class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Close</span>
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="page_modal_loading" class="flex items-center justify-center w-full h-full text-xl">
                    Loading...
                </div>
                <iframe id="page_modal_iframe" class="w-full h-full" src="/notion/page/36fc84c3-a6cd-4bf8-8387-7558a5f08147"
                    onload="document.getElementById('page_modal_loading').classList.add('hidden');"></iframe>
            </div>
        </div>
    </div>

    <script>
        function openPage(url) {
            document.getElementById('page_modal').classList.add('visible');
            document.getElementById('page_modal_loading').classList.remove('hidden');
            document.getElementById('page_modal').classList.remove('hidden');
            document.getElementById('page_modal_iframe').setAttribute('src', url);

        }

        function closePage() {
            document.getElementById('page_modal').classList.add('hidden');
            document.getElementById('page_modal').classList.remove('visible');
            document.getElementById('page_modal_iframe').setAttribute('src', "");
        }

    </script>

@endsection
