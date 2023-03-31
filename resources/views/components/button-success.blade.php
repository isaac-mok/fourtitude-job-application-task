<button {{ $attributes->merge(['class' => 'bg-green-600 text-white rounded px-4 py-2 hover:shadow hover:bg-green-500 transition']) }}>
    {{ $slot }}
</button>
