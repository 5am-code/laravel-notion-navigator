@extends('app')

@section('content')
    <a class="inline-block gap-2 px-2 py-1 mb-2 duration-300 transform bg-gray-200 border border-transparent rounded hover:-translate-x-1 hover:bg-gray-300 hover:border-gray-600" href="/notion" onclick="closePage();">
        <span class="flex gap-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
        </svg> Back</span>
    </a>

    <h1 class="mb-2 text-2xl">📑 {{ $page->getTitle() }}</h1>

    @foreach ($page->getProperties() as $property)
        <x-notion-property :property="$property"/>
    @endforeach

    @foreach ($blocks as $block)
        <div class="mt-2">
            {{ json_encode($block->getRawResponse()) }}
        </div>
    @endforeach
@endsection
