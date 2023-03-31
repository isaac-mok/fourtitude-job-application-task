<x-layouts.app>
    Products >> <x-a href="{{ route('products.index') }}">Listing</x-a> || <x-a href="{{ route('products.create') }}">Create</x-a>
    <h1 class="text-3xl">{{ $title }}</h1>
    {{ $slot }}
</x-layouts.app>
