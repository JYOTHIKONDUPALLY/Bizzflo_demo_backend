<?php

namespace App\Domains\Dashboard\Actions;
use Illuminate\Support\Facades\Auth;
use App\Domains\Customer\Models\customers;
use App\Domains\Orders\Models\orders;
use App\Exceptions\UserException;

class DashboardDataAction
{
    public function handle ($request)
    {
     $User = Auth::guard('users')->user();
      if (!$User) {
                throw UserException::unauthorized();
            }
     $tenant_id=$User->tenant_id;
     $location_id=$User->location_id;
     $result=[];
     $customersCount = customers::where('tenant_id', $tenant_id)->count();
     $ordersCount = orders::where('tenant_id', $tenant_id)->where('status','completed')->count();
     $revenue = orders::where('tenant_id', $tenant_id)->where('status','completed')->sum('total_amount');
     $orders = orders::where('tenant_id', $tenant_id)->where('status','completed')->get();
   $profit = 0;
   if($orders){
      foreach ($orders as $order) {
        if($order->orderItems){
           foreach ($order->orderItems as $item) {
            $profit += ($item->lin_total - $item->cost_price) * $item->quantity;
        } 
        }
        
    } 
   }
     $result['customers']=$customersCount;
     $result['orders']=$ordersCount;
     $result['revenue']=$revenue;
     $result['profit']=$profit;
     return $result;
    }
}
