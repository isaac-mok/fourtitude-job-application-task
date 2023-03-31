<x-layouts.app>
    Products >> <a href="{{ route('product.listing') }}" class="text-blue-600 hover:text-blue-800">Listing</a> || Create
    <h1 class="text-3xl">{{ $title }}</h1>
    {{ $slot }}
</x-layouts.app>
