<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
{
    protected Product $product;

    use RefreshDatabase, WithFaker;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->product = Product::factory()->create();
    }

    public function test_status_code_is_ok(): void
    {
        $response = $this->get(route('products.edit', $this->product));

        $response->assertOk();
    }

    public function test_page_shows_all_form_fields(): void
    {
        $response = $this->get(route('products.edit', $this->product));

        $response->assertSee([
            'name="code"',
            'name="name"',
            'name="category"',
            'name="brand"',
            'name="type"',
            'name="description"',
        ], false);
    }

    public function test_all_fields_of_existing_product_are_filled_in_properly(): void
    {
        $response = $this->get(route('products.edit', $this->product));

        $response->assertSee([
            "value=\"{$this->product->code}\"",
            "value=\"{$this->product->name}\"",
            "value=\"{$this->product->category}\"",
            "value=\"{$this->product->brand}\"",
            "value=\"{$this->product->type}\"",
        ], false);
        $response->assertSee($this->product->description);
    }

    public function test_page_shows_code_field_as_disabled(): void
    {
        $response = $this->get(route('products.edit', $this->product));

        $response->assertSee("value=\"{$this->product->code}\" disabled=\"disabled\"", false);
    }

    public function test_page_shows_link_to_products_index(): void
    {
        $response = $this->get(route('products.edit', $this->product));

        $response->assertSee(route('products.index'));
    }

    public function test_page_shows_link_to_create_product(): void
    {
        $response = $this->get(route('products.edit', $this->product));

        $response->assertSee(route('products.create'));
    }

    public function test_not_found_page_returned_when_accessing_nonexisting_product(): void
    {
        $faker = $this->faker();

        $response = $this->get(route('products.edit', $faker->numberBetween()));

        $response->assertNotFound();
    }
}
