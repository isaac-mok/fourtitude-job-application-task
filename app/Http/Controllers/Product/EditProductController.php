<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class EditProductController extends Controller
{
    public function get(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }

    public function post(Product $product, EditProductRequest $request)
    {
        $validated = $request->validated();

        $product->update($validated);

        return back()
            ->with('status', 'success');
    }
}
