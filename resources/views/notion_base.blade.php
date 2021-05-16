@extends('app')

@section('content')

    <img class="m-3 w-44" src="https://cdn.worldvectorlogo.com/logos/notion-2.svg" />
    <span>All Pages and Databases included in your integration</span>

    @foreach ($entities as $entity)
        @if ($entity->getObjectType() == 'page')
            <a class="block px-4 py-2 mt-1 duration-200 transform bg-white border-gray-200 rounded shadow w-96 hover:shadow-lg hover:translate-x-2"
                href="/notion/page/{{ $entity->getId() }}">📑
            @else
                <a class="block px-4 py-2 mt-1 duration-200 transform bg-white border-gray-200 rounded shadow w-96 hover:shadow-lg hover:translate-x-2"
                    href="/notion/database/{{ $entity->getId() }}">📚
        @endif
        {{ $entity->getTitle() }}
        </a>
        </div>
    @endforeach
@endsection
