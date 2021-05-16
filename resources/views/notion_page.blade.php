@extends('app')

@section('content')
    <a href="{{ url()->previous() }}">Back</a>
    <h1 class="text-2xl">📑 {{ $page->getTitle() }}</h1>

    @foreach ($page->getProperties() as $property)
        @if (is_array($property->getRawContent()))
            <div>{{ $property->getTitle() }}:{{ json_encode($property->getRawContent()) }}</div>
        @else
            <div>{{ $property->getTitle() }}:{{ $property->getRawContent() }}</div>
        @endif
    @endforeach

    @foreach ($blocks as $block)
        <div class="mt-2">
            {{ json_encode($block->getRaw()) }}
        </div>
    @endforeach
@endsection
