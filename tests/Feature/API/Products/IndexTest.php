<?php

namespace Tests\Feature\API\Products;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_code_is_ok(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->get(route('api.products.index'));

        $response->assertOk();
    }

    public function test_page_states_no_products_when_products_table_is_empty(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->get(route('api.products.index'));

        $response->assertJson([
            'data' => []
        ]);
    }

    public function test_page_shows_correct_model_details(): void
    {
        $products = Product::factory(3)->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->get(route('api.products.index'));

        $response->assertJson([
            'data' => $products->map(fn ($product) => [
                'id' => $product->id,
                'code' => $product->code,
                'name' => $product->name,
                'category' =>$product->category,
                'brand' => $product->brand,
                'type' => $product->type,
                'description' => $product->description,
            ])->toArray(),
        ]);
    }

    public function test_response_has_pagination_when_products_exist(): void
    {
        Product::factory(ProductController::ITEMS_PER_PAGE + 1)->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->get(route('api.products.index'));
        
        $response->assertJson(fn (AssertableJson $json) => 
            $json->has('data')
                ->has('links')
                ->has('meta')
        );
    }

    public function test_response_has_pagination_when_products_does_not_exist(): void
    {
        $this->assertDatabaseEmpty(new Product);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->get(route('api.products.index'));
        
        $response->assertJson(fn (AssertableJson $json) => 
            $json->has('data')
                ->has('links')
                ->has('meta')
        );
    }
}
