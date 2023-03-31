<?php

namespace Tests\Feature\API\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = Product::factory()->create();
    }

    public function test_product_can_be_deleted(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->delete(route('api.products.destroy', $this->product));

        $data = [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'category' => $this->product->category,
            'brand' => $this->product->brand,
            'type' => $this->product->type,
            'description' => $this->product->description,
        ];

        $response->assertOk();
        $response->assertJson($data);
        $this->assertDatabaseMissing($this->product, $data);
    }

    public function test_404_returned_when_accessing_nonexisting_product(): void
    {
        $faker = $this->faker();

        $response = $this->delete(route('api.products.destroy', $faker->numberBetween()));

        $response->assertNotFound();
    }
}
