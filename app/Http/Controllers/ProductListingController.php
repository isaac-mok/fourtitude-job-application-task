<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductListingController extends Controller
{
    public function __invoke()
    {
        $products = Product::paginate(5)->withQueryString();

        return view('product.listing', [
            'products' => $products,
        ]);
    }
}
