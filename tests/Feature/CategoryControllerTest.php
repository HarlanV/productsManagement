<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public array $categoryData;
    public Category $category;

    /**
     * A basic feature test example.
     *
     * @return void
     */ 
    public function setUp(): void
    {
        parent::setUp();

        $this->categoryData = Category::factory()
            ->make()
            ->toArray();

        $this->category = Category::factory()
            ->create();

        Category::factory()->count(3)->create();
    }

    public function testCreateCategory()
    {
        $response = $this->postJson(
            route('categories.store'),
            $this->categoryData
        );

        $response->assertSuccessful();

        $this->assertDatabaseHas('categories', $this->categoryData);
    }

    public function testUpdateCategory()
    {
        $response = $this->putJson(
            route('categories.update', [$this->category->id]),
            $this->categoryData
        );

        $response->assertSuccessful();

        $this->assertDatabaseHas('categories', $this->categoryData);
    }

    public function testDeleteCategory()
    {
        $response = $this->deleteJson(
            route('categories.destroy', [$this->category->id])
        );

        $response->assertSuccessful();
    }

    public function testListAllCategories()
    {
        $response = $this->getJson(
            route('categories.index')
        );

        $this->assertEquals(
            json_encode(
                Category::all()->toArray()
            ),
            $response->getContent()
        );
    }

    public function testGetCategories()
    {
        $response = $this->getJson(
            route('categories.show', [$this->category->id])
        );

        $var1 = json_decode(
            json_encode(
                $this->category->toArray()
            )
        );

        $var2 = json_decode($response->getContent());

        $this->assertEquals($var1, $var2);
    }
}
