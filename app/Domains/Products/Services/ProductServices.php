<?php

namespace App\Domains\Products\Services;

use App\Interface\ProductServiceInterface;
use App\Domains\Products\Actions\GetAllProductsAction;
use App\Domains\Products\Actions\CreateProductAction;
use App\Domains\Products\Actions\DeleteProductAction;
use App\Domains\Products\Actions\AddInventoryAction;
use App\Domains\Products\Actions\UpdateInventoryAction;


class ProductServices implements ProductServiceInterface {

    protected GetAllProductsAction $getAllProductsAction;
    protected CreateProductAction $CreateProductsAction;
    protected DeleteProductAction $DeleteProductAction;
    protected UpdateInventoryAction $UpdateInventoryAction;
    protected AddInventoryAction $AddInventoryAction;

    public function __construct(GetAllProductsAction $getAllProductsAction , CreateProductAction $CreateProductsAction, DeleteProductAction $DeleteProductAction, AddInventoryAction $AddInventoryAction , UpdateInventoryAction $UpdateInventoryAction) {
        $this->getAllProductsAction = $getAllProductsAction;
        $this->CreateProductsAction = $CreateProductsAction;
        $this->DeleteProductAction = $DeleteProductAction;
        $this->AddInventoryAction = $AddInventoryAction;
        $this->UpdateInventoryAction = $UpdateInventoryAction;
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

    public function addInventory($data) {
      // dd($data);
      return $this->AddInventoryAction->handle($data);
    }

    public function updateInventory($data,$id) {
      // dd($data);
      return $this->UpdateInventoryAction->handle($data, $id);
    }
}
?>