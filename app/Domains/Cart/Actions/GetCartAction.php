<?php

namespace App\Domains\Cart\Actions;

use App\Domains\Orders\Models\order_items;
use App\Domains\Orders\Models\orders;
use Illuminate\Container\Attributes\Auth;
use App\Exceptions\ProductException;
use Illuminate\Auth\AuthenticationException;

class GetCartAction
{

    public function handle($request)
    {
        try {
            $customer = auth('customer')->user();
            if ($customer) {
                $order =  orders::where('customer_id', $customer->customer_id)
                    ->where('status', 'Cart')
                    ->first();
            }
            $user = auth('users')->user();
            if ($user) {
                $order = orders::where('customer_id', $request->customer_id)
                    ->where('status', 'Cart')
                    ->first();
            }
            if ($order) {
                $orderItems = order_items::where('order_id', $order->order_id)->get();
                if ($orderItems->isEmpty()) {
                    throw  ProductException::EmptyCart('No items in cart');
                }
                return $orderItems;
            }
            if (!$order) {
                throw  ProductException::EmptyCart('No items in cart');
            }
        } catch (AuthenticationException $e) {
            throw $e;
        } catch (ProductException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
