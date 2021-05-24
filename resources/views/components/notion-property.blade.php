<div>
    @if ($showPropertyName ?? true) {{ $property->getTitle() }} : @endif
    @if ($property->getType() == 'text' || $property->getType() == 'title')
        {{ $property->getPlainText() }}
    @elseif ($property->getType() == 'multi_select')
        @foreach ($property->getItems() as $selectItem)
            <div class="inline-block px-2 py-1 ml-1 text-sm rounded"
                style="background-color:{{ $selectItem->getColor() == 'default' ? 'lightgray' : $selectItem->getColor() }}">
                {{ $selectItem->getName() }}
            </div>
        @endforeach
    @elseif ($property->getType() == 'select')
        <div class="inline-block px-2 py-1 ml-1 text-sm rounded"
            style="background-color:{{ $property->getColor() == 'default' ? 'lightgray' : $property->getColor() }}">
            {{ $property->getName() }}
        </div>
    @elseif (is_array($property->getContent()) || is_object($property->getContent()))
        {{ json_encode($property->getContent()) }}
    @else
        {{ $property->getContent() }}
    @endif
</div>
