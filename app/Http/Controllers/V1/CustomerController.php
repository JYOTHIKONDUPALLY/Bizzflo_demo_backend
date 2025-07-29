<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\CustomerServiceInterface;
use App\Domains\Dashboard\Services\CustomerService;
use App\Http\Resources\ApiResponseResource;
use Razorpay\Api\Customer;
use App\Exceptions\UserException;
use App\Http\Resources\CustomerListResource;

class CustomerController extends Controller
{
    protected CustomerServiceInterface $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function CustomerLists(){
        try{
 $response = $this->customerService->CustomerLists();
        return new ApiResponseResource(
            // $response,
             CustomerListResource::collection($response),
            '',
            200
        );
        }catch(UserException $e){
            return response()->json(new ApiResponseResource(
                null,
                $e->getMessage(),
                $e->getCode() ?: 401,
                true
            ),$e->getCode() ?: 401);
        }catch(\Throwable $e){
            return response()->json(new ApiResponseResource(
                null,
                'Internal Server Error: ' . $e->getMessage(),
                500
            ), 500);
        }
       
    }
}
