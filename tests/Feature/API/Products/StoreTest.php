<?php

namespace Tests\Feature\API\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_product_can_be_stored_with_all_fields(): void
    {
        $product = Product::factory()->make();
        $data = [
            'code' => $product->code,
            'name' => $product->name,
            'category' => $product->category,
            'brand' => $product->brand,
            'type' => $product->type,
            'description' => $product->description,
        ];
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post(route('api.products.store'), $data);

        $response->assertOk();
        $response->assertJson($data);
        $this->assertDatabaseHas($product, $data);
    }
    
    public function test_product_can_be_stored_with_minimal_required_fields(): void
    {
        $product = Product::factory()->make();
        $data = [
            'code' => $product->code,
            'name' => $product->name,
            'category' => $product->category,
        ];
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post(route('api.products.store'), $data);

        $response->assertOk();
        $response->assertValid(['brand', 'type', 'description']);
        $response->assertJson([
            ...$data,
            'brand' => null,
            'type' => null,
            'description' => null,
        ]);
        $this->assertDatabaseHas($product, [
            ...$data,
            'brand' => null,
            'type' => null,
            'description' => null,
        ]);
    }

    public function test_errors_are_returned_when_required_fields_are_missing(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post(route('api.products.store'), []);

        $response->assertStatus(422);
        $response->assertInvalid(['code', 'name', 'category']);

        $this->assertDatabaseEmpty(new Product);
    }

    public function test_errors_are_returned_when_fields_are_above_maximum_length(): void
    {
        $faker = $this->faker();
        $data = [
            'code' => $faker->realText(300),
            'name' => $faker->realText(300),
            'category' => $faker->realText(300),
            'brand' => $faker->realText(300),
            'type' => $faker->realText(300),
            'description' => $faker->realText(11000),
        ];
        
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post(route('api.products.store'), $data);

        $response->assertStatus(422);
        $response->assertInvalid([
            'code',
            'name',
            'category',
            'brand',
            'type',
            'description'
        ]);

        $this->assertDatabaseEmpty(new Product);
    }
}
