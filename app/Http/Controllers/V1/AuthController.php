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
use App\Domains\Admin\Requests\AdminLoginRequest;
use App\Interface\AdminServiceInterface;
use App\Domains\Admin\Services\AdminService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Exceptions\UserException;

class AuthController extends Controller
{
   protected UserServiceInterface $userService;
   protected CustomerServiceInterface $customerService;
   protected AdminServiceInterface $adminService;

   public function __construct(UserServiceInterface $userService, CustomerServiceInterface $customerService, AdminServiceInterface $adminService)
   {
      $this->userService = $userService;
      $this->customerService = $customerService;
      $this->adminService = $adminService;
   }
   function businessSignUp(UserRegisterRequest $request)
   {
      $validated = $request->validated();
      $user  = $this->userService->registerBusinessUser($validated);
      return new ApiResponseResource(
         $user,
         'Business User has been created successfully',
         200
      );
   }

   function businessLogin(UserLoginRequest $request){
   try{
      $validator = $request->validated();
      $data = $this->userService->loginBusinessUser($validator);
      return new ApiResponseResource(
         $data,
         'Business User has been logged successfully',
         200
      );
   }catch (UserException $e) {
        return response()->json(new ApiResponseResource(
            null,
            $e->getMessage(),
            $e->getCode() ?: 401,
            true
        ), $e->getCode() ?: 401);

    } catch (\Throwable $e) {
        return response()->json(new ApiResponseResource(
            null,
            'Internal Server Error: ' . $e->getMessage(),
            500
        ), 500);
    }
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

   function adminLogin(AdminLoginRequest $request)
   {
      try{
 $validator = $request->validated();
      $token = $this->adminService->loginAdminUser($validator);
      return new ApiResponseResource(
         ['token' => $token],
         'Admin User has been logged successfully',200);
      }catch (AuthenticationException $e) {
        return response()->json([
            'error' => true,
            'status' => 401,
            'message' => 'Unauthorized Access: Invalid credentials',
        ], 401);
    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'status'=> 500,
            'message' => 'Server Error: ' . $e->getMessage(),
        ], 500);
    }
     
   }

   function adminLogout(Request $request){
      try{
      $response = $this->adminService->logoutAdminUser($request);
      return new ApiResponseResource(
        "",
          $response,
         200
      );
   }catch (AuthenticationException $e) {
      return response()->json([
         'error'=> true,
         'status' => 401,
         'message'=> 'Unauthorized Access: Invalid credentials'
      ]);
   }catch(\Exception $e) {
      return response()->json([
         'error'=> true,
         'status' => 500,
         'message'=> 'Server Error: ' . $e->getMessage()
      ]);
   }
   }
}
