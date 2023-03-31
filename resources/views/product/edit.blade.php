<x-layouts.product title="Edit Product">
    <form action="{{ route('product.postEdit', ['product' => $product]) }}" method="POST" class="border rounded my-2 px-4 py-4">
        @csrf
        
        <div class="flex items-center mb-4">
            <x-label for="code" class="text-center block sm:flex-1 w-24">Code*:</x-label>
            <div class="flex-[4]">
                <x-input id="code" name="code" type="text" class="w-full bg-gray-200 text-gray-500" value="{{ $product->code }}" disabled></x-input>
                <x-input-error :messages="$errors->get('code')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="name" class="text-center block sm:flex-1 w-24">Name*:</x-label>
            <div class="flex-[4]">
                <x-input id="name" name="name" type="text" placeholder="Red Dinner Gown" class="w-full" maxlength="191" value="{{ old('name', $product->name) }}" required autofocus></x-input>
                <x-input-error :messages="$errors->get('name')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="category" class="text-center block sm:flex-1 w-24">Category*:</x-label>
            <div class="flex-[4]">
                <x-input id="category" name="category" type="text" placeholder="Fashion" class="w-full" maxlength="191" value="{{ old('category', $product->category) }}" required></x-input>
                <x-input-error :messages="$errors->get('category')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="brand" class="text-center block sm:flex-1 w-24">Brand:</x-label>
            <div class="flex-[4]">
                <x-input id="brand" name="brand" type="text" placeholder="No Brand" class="w-full" maxlength="191" value="{{ old('brand', $product->brand) }}"></x-input>
                <x-input-error :messages="$errors->get('brand')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="type" class="text-center block sm:flex-1 w-24">Type:</x-label>
            <div class="flex-[4]">
                <x-input id="type" name="type" type="text" placeholder="Woman Dress" class="w-full" maxlength="191" value="{{ old('type', $product->type) }}"></x-input>
                <x-input-error :messages="$errors->get('type')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="description" class="text-center block sm:flex-1 w-24">Description:</x-label>
            <div class="flex-[4]">
                <x-textarea id="description" name="description" type="text" class="w-full" maxlength="10000">{{ old('description', $product->description) }}</x-textarea>
                <x-input-error :messages="$errors->get('description')" />
            </div>
        </div>
        <div class="flex justify-center mb-4">
            <x-button-success type="submit">Save</x-button-success>
        </div>
    </form>
</x-layouts.product>
