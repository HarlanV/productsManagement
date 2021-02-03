<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Serviço dos tipos de produtos.
     * 
     * @var \App\Services\CategoryService
     */
    public CategoryService $service;

    /**
     * Nova instância do CategoryController.
     * 
     * @param   \App\Services\CategoryService   $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Retorna todas as categorias cadastradas.
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
     * Armazena uma nova cateogira.
     * 
     * @param   \App\Http\Requests\CategoryRequest  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->create(
                $request->validated(),
            ),
            Response::HTTP_CREATED
        );
    }

    /**
     * Retorna uma categoria especifica.
     * 
     * @param   \App\Models\Category $category
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category, Response::HTTP_OK);
    }

    /**
     * Atualiza um tipo especifico.
     * 
     * @param   \App\Http\Requests\CategoryRequest  $request
     * @param   \App\Models\Category    $category
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        return response()->json(
            $this->service->update(
                $category,
                $request->validated()
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Remove um tipo armazenado.
     * 
     * @param   \App\Models\Category    $category
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        return response()
            ->json(
                ['success' => $this->service->delete($category)],
                Response::HTTP_OK
        );
    }
}
