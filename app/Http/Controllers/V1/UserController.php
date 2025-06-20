<?php
namespace App\Http\Controllers\V1;

use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Interface\UserServiceInterface;
use App\Http\Resources\ApiResponseResource;
use Illuminate\Http\Request;
use App\Http\Resources\UserResponseResource;
use App\Domains\User\Requests\GetUserRequest;

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
            $users = $this->userService->getAllBusinessUsers(
                $validated['search'] ?? '',
                $validated['sort'] ?? 'name',
                $validated['order'] ?? 'desc',
                $validated['limit'] ?? 10,
                $validated['id'] ?? ''
            );
            return UserResponseResource::collection($users);
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