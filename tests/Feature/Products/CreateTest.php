<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_code_is_ok(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertOk();
    }

    public function test_page_shows_all_form_fields(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertSee([
            'name="code"',
            'name="name"',
            'name="category"',
            'name="brand"',
            'name="type"',
            'name="description"',
        ], false);
    }

    public function test_page_shows_link_to_products_index(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertSee(route('products.index'));
    }
}
