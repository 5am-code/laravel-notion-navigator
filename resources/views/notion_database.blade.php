<a href="{{ url()->previous() }}">Back</a>
<h1>{{ $database->getTitle() }} <small>(database)</small></h1>


@foreach ($entries as $entry)
    <div>
        <h4><a href="/notion/page/{{$entry->getId()}}">{{ $entry->getTitle() }}</a></h4>

        @foreach ($entry->getProperties() as $property)
            @if (is_array($property->getRawContent()))
                <div>{{ $property->getTitle() }}:{{ json_encode($property->getRawContent()) }}</div>
            @else
                <div>{{ $property->getTitle() }}:{{ $property->getRawContent() }}</div>
            @endif
        @endforeach

    </div>
    {{-- @if (is_array($block->getRawContent()))
        <div>{{ $property->getTitle() }}:{{ json_encode($property->getRawContent()) }}</div>
    @else
        <div>{{ $property->getTitle() }}:{{ $property->getRawContent() }}</div>
    @endif --}}
@endforeach
