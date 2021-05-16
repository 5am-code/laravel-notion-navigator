@foreach ($entities as $entity)
    @if ($entity->getObjectType() == 'page')
        <div><a href="/notion/page/{{ $entity->getId() }}">📑 {{ $entity->getTitle() }} </a></div>
    @else
        <div><a href="/notion/database/{{ $entity->getId() }}">📚 {{ $entity->getTitle() }}</a></div>
    @endif
@endforeach
