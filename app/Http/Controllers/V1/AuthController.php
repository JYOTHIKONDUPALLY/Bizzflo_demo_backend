<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\UserServiceInterface;
use App\Domains\User\Requests\UserLoginRequest;
use App\Domains\User\Requests\UserRegisterRequest;
use App\Domains\User\Requests\UserLogoutRequest;
use App\Interface\CustomerServiceInterface;
use App\Http\Resources\ApiResponseResource;
use App\Domains\Customer\Requests\CustomerRegisterRequest;
use App\Domains\Customer\Requests\CustomerLoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   protected UserServiceInterface $userService;
   protected CustomerServiceInterface $customerService;

   public function __construct(UserServiceInterface $userService, CustomerServiceInterface $customerService)
   {
      $this->userService = $userService;
      $this->customerService = $customerService;
   }
   function businessSignUp(UserRegisterRequest $request)
   {
      $validated = $request->validated();
      $token  = $this->userService->registerBusinessUser($validated);
      return new ApiResponseResource(
         ['token' => $token],
         'Business User has been created successfully',
         200
      );
   }

   function businessLogin(UserLoginRequest $request)
   {
      $validator = $request->validated();
      $token = $this->userService->loginBusinessUser($validator);
      return new ApiResponseResource(
         ['token' => $token],
         'Business User has been logged successfully',
         200
      );
   }

   function businessLogout(Request $request){
      $response = $this->userService->logoutBusinessUser($request);
      return new ApiResponseResource(
         $response,
         '',
         200
      );
   }
   function customerSignup(CustomerRegisterRequest $request)
   {
      $validator = $request->validated();

      $token = $this->customerService->registerCustomer($validator);
      return new ApiResponseResource(
         ['token' => $token],
         'Customer has been signed successfully',
         200
      );
   }
   function customerLogin(CustomerLoginRequest $request)
   {
      $validator = $request->validated();

      $token = $this->customerService->loginCustomer($validator);
      return new ApiResponseResource(
         ['token' => $token],
         'Customer has been logged successfully',
         200
      );
   }
    function CustomerLogout(Request $request){
      $response = $this->customerService->logoutCustomer($request);
      return new ApiResponseResource(
         $response,
         '',
         200
      );
   }
}
