<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\ProductServiceInterface;
use App\Http\Resources\ProductResource;
use App\Domains\Products\Requests\GetProductsRequest;
use App\Domains\Products\Requests\CreateProductRequest;
use App\Domains\Products\Requests\DeleteProductRequest;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }
    public function ProductsList(GetProductsRequest $request)
    {
        try {
            $validated = $request->validated();
            $products = $this->productService->getAllProducts(
                $validated['search'] ?? '',
                $validated['sort'] ?? 'name',
                $validated['order'] ?? 'desc',
                $validated['limit'] ?? 10,
                $validated['id'] ?? ''
            );
            return ProductResource::collection($products);
            // return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function ProductCreateOrUpdate(CreateProductRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $product = $this->productService->createProducts($validated);
            // return ProductResource::collection($product);
            return response()->json([
                'error' => 'false',
                'status' => $request['product_id'] ? 200 : 201,
                'message' => $request['product_id'] ? 'Product has been updated successfully' : 'Product has been created successfully',
                'data' => [
                    'product' => $product
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'true',
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function ProductDelete(DeleteProductRequest $request): JsonResponse
    {
        try {
            // $validated = $request->validate();
            $product = $this->productService->deleteProducts($request);
            return response()->json([
                'error' => 'false',
                'status' => 200,
                'message'=> 'Product has been deleted successfully',
                'data'=>[
                    'product'=> $product
                ],
            ], 200);
        }
        catch (\Exception $e) {
            return response()->json(['error'=> 'true',
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
