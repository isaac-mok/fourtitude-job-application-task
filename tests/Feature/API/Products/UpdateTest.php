<?php

namespace Tests\Feature\API\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = Product::factory()->create();
    }

    public function test_product_can_be_updated_with_all_fields(): void
    {
        $product = Product::factory()->make();
        $data = [
            'name' => $product->name,
            'category' => $product->category,
            'brand' => $product->brand,
            'type' => $product->type,
            'description' => $product->description,
        ];
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->put(route('api.products.update', $this->product), $data);

        $response->assertOk();
        $response->assertJson($data);
        $this->assertDatabaseHas($product, $data);
    }

    public function test_errors_are_returned_when_required_fields_are_missing(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->put(route('api.products.update', $this->product), []);

        $response->assertStatus(422);
        $response->assertInvalid(['name', 'category', 'brand', 'type', 'description']);

        $this->assertDatabaseHas($this->product, [
            'code' => $this->product->code,
            'name' => $this->product->name,
            'category' => $this->product->category,
            'brand' => $this->product->brand,
            'type' => $this->product->type,
            'description' => $this->product->description,
        ]);
    }

    public function test_errors_are_returned_when_fields_are_above_maximum_length(): void
    {
        $faker = $this->faker();
        $data = [
            'name' => $faker->realText(300),
            'category' => $faker->realText(300),
            'brand' => $faker->realText(300),
            'type' => $faker->realText(300),
            'description' => $faker->realText(11000),
        ];
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->put(route('api.products.update', $this->product), $data);

        $response->assertStatus(422);
        $response->assertInvalid([
            'name',
            'category',
            'brand',
            'type',
            'description'
        ]);

        $this->assertDatabaseHas($this->product, [
            'code' => $this->product->code,
            'name' => $this->product->name,
            'category' => $this->product->category,
            'brand' => $this->product->brand,
            'type' => $this->product->type,
            'description' => $this->product->description,
        ]);
    }

    public function test_code_cannot_be_updated(): void
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
            ->put(route('api.products.update', $this->product), $data);

        $response->assertOk();
        $response->assertJson([
            ...$data,
            'code' => $this->product->code,
        ]);
        $this->assertDatabaseHas($product, [
            ...$data,
            'code' => $this->product->code,
        ]);
        $this->assertDatabaseMissing($product, [
            'code' => $data['code'],
        ]);
    }

    public function test_404_returned_when_accessing_nonexisting_product(): void
    {
        $faker = $this->faker();

        $response = $this->put(route('api.products.update', $faker->numberBetween()));

        $response->assertNotFound();
    }
}
