<x-layouts.product title="Products">
    <div class="overflow-auto">
        <table class="border border-black my-4 min-w-full">
            <thead>
                <tr>
                    <x-th>ID</x-th>
                    <x-th>Code</x-th>
                    <x-th>Name</x-th>
                    <x-th>Category</x-th>
                    <x-th>Brand</x-th>
                    <x-th>Type</x-th>
                    <x-th>Description</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <x-td>{{ $product->id }}</x-td>
                    <x-td>{{ $product->code }}</x-td>
                    <x-td>{{ $product->name }}</x-td>
                    <x-td>{{ $product->category }}</x-td>
                    <x-td>{{ $product->brand }}</x-td>
                    <x-td>{{ $product->type }}</x-td>
                    <x-td>{{ $product->description }}</x-td>
                </tr>
                @empty
                <tr>
                    <x-td colspan="7">No products.</x-td>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{ $products->links() }}
</x-layouts.product>
