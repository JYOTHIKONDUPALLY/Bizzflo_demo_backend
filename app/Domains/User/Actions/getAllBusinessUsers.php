<?php
namespace App\Domains\User\Actions;



use App\Domains\User\Models\User;

class GetAllBusinessUsers
{
    public function handle($request)
    {
        try {
            $businessUsers = User::get();
            // $query = User::query();

            // if (!empty($request->search)) {
            //     $query->where('name', 'like', '%' . $request->search . '%');
            // }

            // if (!empty($request->sort) && !empty($request->order)) {
            //     $query->orderBy($request->sort, $request->order);
            // }

            // if (!empty($request->limit)) {
            //     return $query->limit($request->limit)->get();
            // }

            // if (!empty($request->id)) {
            //     return $query->where('id', $request->id)->get();
            // }

            // return $query->get();
            return $businessUsers;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
?>