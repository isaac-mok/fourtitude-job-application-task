<?php

namespace Tests\Feature\API\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = Product::factory()->create();
    }

    public function test_product_can_be_shown(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->get(route('api.products.show', $this->product));

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
    }

    public function test_404_returned_when_accessing_nonexisting_product(): void
    {
        $faker = $this->faker();

        $response = $this->get(route('api.products.show', $faker->numberBetween()));

        $response->assertNotFound();
    }
}
