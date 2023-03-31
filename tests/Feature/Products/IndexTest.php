<?php

namespace Tests\Feature\Products;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_code_is_ok(): void
    {
        $response = $this->get(route('products.index'));

        $response->assertOk();
    }

    public function test_page_states_no_products_when_products_table_is_empty(): void
    {
        $response = $this->get(route('products.index'));

        $response->assertSee('No products.');
    }

    public function test_page_shows_correct_model_details(): void
    {
        $products = Product::factory(3)->create();

        $response = $this->get(route('products.index'));

        foreach ($products as $product) {
            $response->assertSee([
                $product->id,
                $product->code,
                $product->name,
                $product->category,
                $product->brand,
                $product->type,
                $product->description,
            ]);
        }
    }

    public function test_pagination_links_are_shown_when_products_more_than_items_per_page(): void
    {
        Product::factory(ProductController::ITEMS_PER_PAGE + 1)->create();

        $response = $this->get(route('products.index'));
        
        $response->assertSee(route('products.index', ['page' => 2]));
    }

    public function test_pagination_links_are_not_shown_when_products_less_or_equal_to_items_per_page(): void
    {
        Product::factory(ProductController::ITEMS_PER_PAGE)->create();

        $response = $this->get(route('products.index'));
        
        $response->assertDontSee(route('products.index', ['page' => 2]));
    }

    public function test_link_to_create_product_exists(): void
    {
        $response = $this->get(route('products.index'));

        $response->assertSee(route('products.create'));
    }

    public function test_link_to_update_product_exists(): void
    {
        $products = Product::factory(3)->create();

        $response = $this->get(route('products.index'));

        foreach ($products as $product) {
            $response->assertSee(route('products.edit', ['product' => $product]));
        }
    }
}
