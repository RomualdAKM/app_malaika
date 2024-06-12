@props(['title', 'icon', 'value', 'route'])

<div class="flex p-4 bg-white rounded shadow-xs">
    <div class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full">
        {!! $icon !!}
    </div>
    <div>
        <p class="mb-2 text-sm font-medium text-gray-600">
            {{ $title }} : {{ $value }}
        </p>
        <p class="mb-2 text-lg font-semibold text-gray-700">
        </p>
        <hr>
        <p class="mt-2 text-sm font-medium text-gray-600">
            <a href="{{ $route }}">Voir plus</a>
        </p>
    </div>
</div>
