@extends('app')

@section('content')
    <a href="{{ url()->previous() }}">Back</a>
    <h1 class="text-2xl">📚 {{ $database->getTitle() }}</h1>


    @foreach ($entries as $entry)
        <div>
            <h4><a href="/notion/page/{{ $entry->getId() }}">{{ $entry->getTitle() }}</a></h4>

            @foreach ($entry->getProperties() as $property)
                <div class="mt-2">
                    @if (is_array($property->getRawContent()))
                        {{ $property->getTitle() }}:{{ json_encode($property->getRawContent()) }}

                    @else
                        {{ $property->getTitle() }}:{{ $property->getRawContent() }}
                    @endif
                </div>
            @endforeach

        </div>
        {{-- @if (is_array($block->getRawContent()))
        <div>{{ $property->getTitle() }}:{{ json_encode($property->getRawContent()) }}</div>
    @else
        <div>{{ $property->getTitle() }}:{{ $property->getRawContent() }}</div>
    @endif --}}
    @endforeach

@endsection
