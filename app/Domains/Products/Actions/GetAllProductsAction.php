<?php

namespace App\Domains\Products\Actions;
use App\Domains\Products\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UserException;

class GetAllProductsAction
{
    public function handle($search, $sort, $order, $limit, $id)
    {
        try {
             $User = Auth::guard('users')->user();
      if (!$User) {
                throw UserException::unauthorized();
            }
            $tenant_id = $User->tenant_id;

            $query = Products::query();
            $query->where('tenant_id', $tenant_id);

            if (!empty($search)) {
                $query->where('name', 'like', '%' . $search . '%');
            }

            if (!empty($sort) && !empty($order)) {
                $query->orderBy($sort, $order);
            }

            if (!empty($limit)) {
                return $query->limit($limit)->get();
            }

            if(!empty($id)) {
                return $query->where('product_id', $id)->get();
            }

            return $query->get();
        } catch (\Exception $e) {
            // Handle or log the exception as needed
            return response()->json(['error' => 'An error occurred while fetching products', $e->getMessage()], 500);
        }
    }
}

?>