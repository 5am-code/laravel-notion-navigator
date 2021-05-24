@extends('app')

@section('content')

    All databases/pages within your integration:
    @foreach ($entities as $entity)
        @if ($entity->getObjectType() == 'page')
            <a class="block px-4 py-2 mt-1 duration-200 transform bg-white border-gray-200 rounded shadow w-96 hover:shadow-lg hover:translate-x-2 hover:bg-indigo-50"
                href="/notion/page/{{ $entity->getId() }}">📑 {{ $entity->getTitle() }} </a>
        @else
            <a class="block px-4 py-2 mt-1 duration-200 transform bg-white border-gray-200 rounded shadow w-96 hover:shadow-lg hover:translate-x-2 hover:bg-indigo-50"
                href="/notion/database/{{ $entity->getId() }}">📚 {{ $entity->getTitle() }} </a>
        @endif
    @endforeach
@endsection
