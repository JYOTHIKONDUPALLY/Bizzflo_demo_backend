<?php
namespace App\Http\Controllers\V1;

use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Interface\UserServiceInterface;
use App\Http\Resources\ApiResponseResource;
use Illuminate\Http\Request;
use App\Http\Resources\UserResponseResource;
use App\Domains\User\Requests\{UpdateUserRequest,GetUserRequest};

class UserController extends Controller
{
    protected UserServiceInterface $userService;
    
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function businessUsersList (GetUserRequest $request){
        try{
            $validated = $request->validated();
            $users = $this->userService->getAllBusinessUsers($validated);

            return new ApiResponseResource(
            $users,
            '',
            200
        );
        }catch (\Exception $e){
            return response()->json([
                'error' => 'true',
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function UpdateUser (UpdateUserRequest $request, $userId){
        try{
            $validated = $request->validated();
            $user = $this->userService->updateUser($validated, $userId);
            return new ApiResponseResource(
            $user,
            'User details has been updated successfully',
            200
        );
        }catch (\Exception $e){
            return response()->json([
                'error' => 'true',
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
?>