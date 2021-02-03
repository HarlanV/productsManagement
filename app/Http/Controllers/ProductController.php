<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Serviço dos tipos de produtos.
     * 
     * @var \App\Services\ProductService
     */
    public ProductService $service;

    /**
     * Nova instância do ProducController.
     * 
     * @param   \App\Services\ProductService   $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Retorna todos os produtos cadastados
     * 
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return response()
        ->json(
            $this->service->list(),
            Response::HTTP_OK
        );
    }

    /**
     * Armazena um novo produto.
     * 
     * @param   \App\Http\Requests\ProductRequest  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->create(
                $request->validated(),
            ),
            Response::HTTP_CREATED
        );
    }

    /**
     * Retorna um produto especifico
     * 
     * @param   \App\Models\Product $product
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Atualiza um tipo especifico.
     * 
     * @param   \App\Http\Requests\ProductRequest  $request
     * @param   \App\Models\Product    $product
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Product $product, ProductRequest $request)
    {
        return response()->json(
            $this->service->update(
                $product,
                $request->validated()
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Remove um tipo armazenado.
     * 
     * @param   \App\Models\Product    $product
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        return response()
        ->json(
            ['success' => $this->service->delete($product)],
            Response::HTTP_OK
    );
    }
}
