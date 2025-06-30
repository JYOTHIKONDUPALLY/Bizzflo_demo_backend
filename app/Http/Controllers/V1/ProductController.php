<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\ProductServiceInterface;
use App\Http\Resources\ProductResource;
use App\Domains\Products\Requests\{GetProductsRequest,CreateProductRequest,DeleteProductRequest,AddInventoryRequest,UpdateInventoryRequest};
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ApiResponseResource;
use Illuminate\Database\Eloquent\Casts\Json;

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
            // return ProductResource::collection($products);
             return new ApiResponseResource(
               $products,
                '',
                200
            );
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', $e->getMessage()], 500);
        }
    }

    public function ProductCreateOrUpdate(CreateProductRequest $request): ApiResponseResource
    {
        $validated = $request->validated();
        $product = $this->productService->createProducts($validated);
        if ($request['product_id']) {
            return new ApiResponseResource(
                $product,
                'Product has been updated successfully',
                200
            );
        } else {

            return new ApiResponseResource(
                $product,
                'Product has been created successfully',
                201
            );
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
                'message' => 'Product has been deleted successfully',
                'data' => [
                    'product' => $product
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'true',
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function AddInventory(AddInventoryRequest $request): ApiResponseResource
    {
        $validated = $request ->validated();
        $Inventory = $this->productService->addInventory($validated);
        return new ApiResponseResource(
            $Inventory,
            'Inventory has been added successfully',
            200
        );
    }

    public function UpdateInventory(UpdateInventoryRequest $request, $inventoryId): ApiResponseResource
    {
        $validated = $request ->validated();
        $Inventory = $this->productService->updateInventory($validated, $inventoryId);
        return new ApiResponseResource(
            $Inventory,
            'Inventory has been updated successfully',
            200
        );
    }

}
