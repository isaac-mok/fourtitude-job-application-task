<x-layouts.product title="Create New Product">
    <form action="{{ route('products.store') }}" method="POST" class="border rounded my-2 px-4 py-4">
        @csrf
        
        <div class="flex items-center mb-4">
            <x-label for="code" class="text-center block sm:flex-1 w-24">Code*:</x-label>
            <div class="flex-[4]">
                <x-input id="code" name="code" type="text" placeholder="P123" class="w-full" maxlength="191" value="{{ old('code') }}" required autofocus></x-input>
                <x-input-error :messages="$errors->get('code')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="name" class="text-center block sm:flex-1 w-24">Name*:</x-label>
            <div class="flex-[4]">
                <x-input id="name" name="name" type="text" placeholder="Red Dinner Gown" class="w-full" maxlength="191" value="{{ old('name') }}" required></x-input>
                <x-input-error :messages="$errors->get('name')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="category" class="text-center block sm:flex-1 w-24">Category*:</x-label>
            <div class="flex-[4]">
                <x-input id="category" name="category" type="text" placeholder="Fashion" class="w-full" maxlength="191" value="{{ old('category') }}" required></x-input>
                <x-input-error :messages="$errors->get('category')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="brand" class="text-center block sm:flex-1 w-24">Brand:</x-label>
            <div class="flex-[4]">
                <x-input id="brand" name="brand" type="text" placeholder="No Brand" class="w-full" maxlength="191" value="{{ old('brand') }}"></x-input>
                <x-input-error :messages="$errors->get('brand')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="type" class="text-center block sm:flex-1 w-24">Type:</x-label>
            <div class="flex-[4]">
                <x-input id="type" name="type" type="text" placeholder="Woman Dress" class="w-full" maxlength="191" value="{{ old('type') }}"></x-input>
                <x-input-error :messages="$errors->get('type')" />
            </div>
        </div>
        <div class="flex items-center mb-4">
            <x-label for="description" class="text-center block sm:flex-1 w-24">Description:</x-label>
            <div class="flex-[4]">
                <x-textarea id="description" name="description" type="text" class="w-full" maxlength="10000">{{ old('description') }}</x-textarea>
                <x-input-error :messages="$errors->get('description')" />
            </div>
        </div>
        <div class="flex justify-center mb-4">
            <x-button-success type="submit">Save</x-button-success>
        </div>
    </form>
</x-layouts.product>
