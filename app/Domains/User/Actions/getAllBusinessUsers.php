<?php
namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;

class getAllBusinessUsers
{
    public function handle($request){
        try{
            $query = User::query();

            if($request->has("search")){
                $query->where('name', 'like', '%' . $request->search . '%');
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
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
?>