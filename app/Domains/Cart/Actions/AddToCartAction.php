<?php

namespace App\Domains\Cart\Actions;

use App\Domains\Customer\Models\Customers;
use App\Domains\Orders\Models\order_items;
use App\Domains\Orders\Models\orders;
use App\Models\Locations;
use App\Exceptions\ProductException;
use App\Models\inventory;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UserException;

class AddToCartAction
{

  public function handle($request)
  {
    try {
             $user = Auth::guard('users')->user();
                  // dd($user);
              $customer = Auth::guard('customer')->user();

         
        if (!$user && !$customer) {
            throw UserException::unauthorized();
        }
     
      $locationId = null;

      if ($customer) {
        $customerId = $customer->customer_id;
        $tenantId = $customer->tenant_id;
      }

      if ($user) {
        $tenantId = $user->tenant_id;
        $customerID = $request['customer_id'];
        $locationId = $user->location_id;
      }

      $productId = $request['product_id'];
      $product_variant_id = $request['varinat_id'] ?? null;

      // check for stock in inventory 

      $query = inventory::where('tenant_id', $tenantId)
        ->where('product_id', $productId);
      if ($product_variant_id) {
        $query->where('variant_id', $product_variant_id);
      };
      $query->where('quantity', '>', 0);
       if($locationId) {
        $query->where('location_id', $locationId);
      }
      $stock = $query->get();
     
      if ($stock->count() === 0) {
        throw         ProductException::OutOfStock();
      }
       $locationId = $stock->first()->location_id;
      $subtotal = ($request['unit_price'] * $request['quantity'])
        + ($request['tax_per_items'] ?? 0 * $request['quantity'])
        - ($request['discount_per_items'] ?? 0 * $request['quantity']);
        if(isset($request['order_id'])){
            $order = orders::where('order_id', $request['order_id'])
            ->where('tenant_id', $tenantId)->first();
            if(!$order){
                throw ProductException::NotFound();
            }
        }else{
        $order = new Orders();
      $order->tenant_id = $tenantId;
      $order->location_id = $locationId ;
      $order->customer_id = $customerId ?? $request["customer_id"];
      $order->order_type = $request['order_type'];      
      $order->status = 'Cart';
      $order->subtotal = $subtotal;
      $order->total_amount = $subtotal;
      $order->created_by_user_id = $customerId ?? $user->id;
      $order->order_date = date('Y-m-d H:i:s');
      $order->save();
        }
    
        $isProductExists = order_items::where('product_id', $request['product_id'])
        ->where('variant_id', $request['variant_id'] ?? null)->get();
        if($isProductExists) {
          
            
        }
      

      $order_items = new order_items();
      $order_items->order_id = $order->order_id;
      $order_items->product_id = $request['product_id'];
      $order_items->variant_id = $request['variant_id'] ?? null;
      $order_items->quantity = $request['quantity'];
      $order_items->unit_price = $request['unit_price'];
      $order_items->discount_per_item = $request['discount_per_items'] ?? 0;
      $order_items->tax_per_item = $request['tax_per_items'] ?? 0;
      $order_items->line_total = ($request['unit_price'] * $request['quantity'])
        + ($request['tax_per_items'] ?? 0 * $request['quantity'])
        - ($request['discount_per_items'] ?? 0 * $request['quantity']);
      $order_items->save();
      $order->subtotal = $order_items->line_total;
      return $order_items;
    } catch(ProductException $e){
      throw $e;
    }catch (\Exception $e) {
      throw $e;
    }
  }
}
