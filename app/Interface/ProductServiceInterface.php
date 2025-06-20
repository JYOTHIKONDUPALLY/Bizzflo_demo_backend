<?php

namespace App\Interface;

interface ProductServiceInterface
{
    public function getAllProducts($search, $sort, $order, $limit, $id);
    public function createProducts( $data);
    public function deleteProducts( $id);
}
