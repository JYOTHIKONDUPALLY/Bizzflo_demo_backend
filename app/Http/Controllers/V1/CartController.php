<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\CartServiceInterface;
use App\Http\Resources\CartResource;
use App\Domains\Cart\Requests\{AddRequest,CheckoutRequest};
use App\Http\Resources\ApiResponseResource;
<<<<<<< HEAD
=======
use App\Exceptions\UserException;
use App\Exceptions\ProductException;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a

class CartController extends Controller
{
    protected CartServiceInterface $cartService;
    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function GetCart()
    {
        $customerId = auth('customer')->user()->id;
        $cart = $this->cartService->GetCart($customerId);
        return CartResource::collection($cart);

    }
    public function AddToCart(AddRequest $request) {
<<<<<<< HEAD
        $validated = $request->validated();
        $cart = $this->cartService->AddToCart($validated);
        return new ApiResponseResource($cart,"Added to Cart!!", 200);
=======
        try{

            $validated = $request->validated();
        $cart = $this->cartService->AddToCart($validated);
        return new ApiResponseResource($cart,"Added to Cart!!", 200);
        }catch (UserException $e) {
            return response()->json(new ApiResponseResource(
                null,
                $e->getMessage(),
                $e->getCode() ?: 401,
                true
            ), $e->getCode() ?: 401);
        }catch (ProductException $e){
            return response()->json(new ApiResponseResource(
                null,
                $e->getMessage(),
                $e->getCode() ?: 400,
                true
            ), $e->getCode() ?: 400);
        } catch (\Throwable $e) {
            return response()->json(new ApiResponseResource(
                null,
                'Internal Server Error: ' . $e->getMessage(),
                500
            ), 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', $e->getMessage()], 500);
        }
        
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
    }

    public function RemoveFromCart($request) {
        $customerId = auth('customer')->user()->id;
        $cart = $this->cartService->RemoveFromCart($customerId,$request);
        return CartResource::collection($cart);
    }
    public function UpdateCart($request) {
        $customerId = auth('customer')->user()->id;
        $cart = $this->cartService->UpdateCart($customerId,$request);
        return CartResource::collection($cart);
    }

    public function CheckoutFromCart( CheckoutRequest $request) {
         $validated = $request->validated();
        $cart = $this->cartService->CheckoutFromCart($validated);
        return new ApiResponseResource($cart,"Checkout Successfully!!", 200);
    }

}
?>