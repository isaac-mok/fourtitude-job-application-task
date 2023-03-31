<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    public function __invoke(CreateProductRequest $request)
    {
        $validated = $request->validated();

        Product::create($validated);

        return redirect()
            ->route('product.listing')
            ->with('status', 'success');
    }
}
