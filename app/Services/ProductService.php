<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    /**
     * Cria um novo produto
     * 
     * @param   array   $product  
     * @return  \App\Models\Product
     */
    public function create(array $data): Product
    {
        return Product::create($data);

    }

    /**
     * Atualiza um produto ja cadatrado com os dados enviados
     * 
     * @param   \App\Models\Product $product
     * @param   array   $data  
     * @return  \App\Models\Product
     */
    public function update(Product $product, array $data): Product
    {
        $product->fill($data);
        $product->save();

        return $product;
    }

    /**
     * Remove um produto do sistema
     * 
     * @param   \App\Models\Product $product
     * @return  bool 
     */
    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    /**
     * Retorna uma lista de produtos
     * 
     * @return  \Illuminate\Database\Eloquent\Collection
     */
    public function list(): Collection
    {
        return Product::all();
    }

}
