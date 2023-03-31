<x-layouts.product title="Products">
    <div class="overflow-auto">
        <table class="border border-black my-4">
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
                @foreach ($products as $product)
                <tr>
                    <x-td>{{ $product->id }}</x-td>
                    <x-td>{{ $product->code }}</x-td>
                    <x-td>{{ $product->name }}</x-td>
                    <x-td>{{ $product->category }}</x-td>
                    <x-td>{{ $product->brand }}</x-td>
                    <x-td>{{ $product->type }}</x-td>
                    <x-td>{{ $product->description }}</x-td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{ $products->links() }}
</x-layouts.product>
