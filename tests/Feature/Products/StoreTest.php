<?php

namespace Tests\Feature\Products;

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
        $response = $this->post(route('products.store'), $data);

        $response->assertRedirectToRoute('products.index');
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
        $response = $this->post(route('products.store'), $data);

        $response->assertValid(['brand', 'type', 'description']);
        $response->assertRedirectToRoute('products.index');
        $this->assertDatabaseHas($product, [
            ...$data,
            'brand' => null,
            'type' => null,
            'description' => null,
        ]);
    }

    public function test_errors_are_returned_when_required_fields_are_missing(): void
    {
        $response = $this->post(route('products.store'), []);

        $response->assertRedirect();
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
        $response = $this->post(route('products.store'), $data);

        $response->assertRedirect();
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
