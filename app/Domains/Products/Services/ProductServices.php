<?php

namespace App\Domains\Products\Services;

use App\Interface\ProductServiceInterface;
use App\Domains\Products\Actions\GetAllProductsAction;
use App\Domains\Products\Actions\CreateProductAction;
use App\Domains\Products\Actions\DeleteProductAction;

class ProductServices implements ProductServiceInterface {

    protected GetAllProductsAction $getAllProductsAction;
    protected CreateProductAction $CreateProductsAction;
    protected DeleteProductAction $DeleteProductAction;

    public function __construct(GetAllProductsAction $getAllProductsAction , CreateProductAction $CreateProductsAction, DeleteProductAction $DeleteProductAction) {
        $this->getAllProductsAction = $getAllProductsAction;
        $this->CreateProductsAction = $CreateProductsAction;
        $this->DeleteProductAction = $DeleteProductAction;
    }

    public function getAllProducts($search, $sort, $order, $limit, $id) {
      return $this->getAllProductsAction->handle($search, $sort, $order, $limit, $id);
    }

    public function createProducts($data) {
      // dd($data);
      return $this->CreateProductsAction->handle($data);
    }
    public function deleteProducts($id) {
      return $this->DeleteProductAction->handle($id);
    }
}
?>