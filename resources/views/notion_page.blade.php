<a href="{{ url()->previous() }}">Back</a>
<h1>{{ $page->getTitle() }} <small>(page)</small></h1>

@foreach ($page->getProperties() as $property)
    @if (is_array($property->getRawContent()))
        <div>{{ $property->getTitle() }}:{{ json_encode($property->getRawContent()) }}</div>
    @else
        <div>{{ $property->getTitle() }}:{{ $property->getRawContent() }}</div>
    @endif
@endforeach

@foreach ($blocks as $block)
    <div style="margin-top:10px;">
        {{json_encode($block->getRaw())}}
    </div>
    {{-- @if (is_array($block->getRawContent()))
        <div>{{ $property->getTitle() }}:{{ json_encode($property->getRawContent()) }}</div>
    @else
        <div>{{ $property->getTitle() }}:{{ $property->getRawContent() }}</div>
    @endif --}}
@endforeach
