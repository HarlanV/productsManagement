<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class CategoryService
{
    public Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Comunicates with the Model type and creates a new type
     * 
     * @param   array   $data
     * @return  \App\Models\Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Comunica com a Model de categoria e atualiza a categoria desejada
     * 
     * @param   \App\Models\Category    $category
     * @param   array   $data
     * @return  \App\Models\Category
     */
    public function update(Category $category, array $data): Category
    {
        $category->fill($data);
        $category->save();

        return $category;
    }

    /**
     * Remove uma categoria
     * 
     * @param   \App\Models\Category    $category
     * @return bool
     */
    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    /**
     * Comunica com a Model de categoria e retorna uma lista de categorias
     * 
     * @return  \App\Models\Category
     */
    public function list(): Collection
    {
        return Category::all();
    }

}
