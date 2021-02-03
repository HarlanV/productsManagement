<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public array $productData;
    public Product $product;


    public function setUp(): void
    {
        parent::setUp();

        $this->productData = Product::factory()
            ->make()
            ->toArray();

        $this->product = Product::factory()
            ->create();

        Product::factory()->count(3)->create();
    }

    public function testCreateProduct()
    {
        $response = $this->postJson(
            route('products.store'),
            $this->productData
        );

        $response->assertSuccessful();

        $this->assertDatabaseHas('products', $this->productData);
    }

    public function testUpdateProduct()
    {
        $response = $this->putJson(
            route('products.update', [$this->product->id]),
            $this->productData
        );

        $response->assertSuccessful();

        $this->assertDatabaseHas('products', $this->productData);
    }

    public function testDeleteProduct()
    {
        $response = $this->deleteJson(
            route('products.destroy', [$this->product->id])
        );

        $response->assertSuccessful();
    }

    public function testListAllProducts()
    {
        $response = $this->getJson(
            route('products.index')
        );

        $this->assertEquals(
            json_encode(
                Product::all()->toArray()
            ),
            $response->getContent()
        );
    }

    public function testGetCategories()
    {
        $response = $this->getJson(
            route('products.show', [$this->product->id])
        );

        $var1 = json_decode(
            json_encode(
                $this->product->toArray()
            )
        );

        $var2 = json_decode($response->getContent());

        $this->assertEquals($var1, $var2);
    }
}
