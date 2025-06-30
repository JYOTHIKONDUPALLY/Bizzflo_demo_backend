<?php
namespace App\Domains\Admin\Actions;

use App\Domains\Admin\Models\admin;
use Illuminator\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Auth\AuthenticationException;

class AdminLoginAction
{
    public function handle(array $data)
    {
        try {
            $admin = admin::whereEmail($data['email'])->first();
            if (!$admin) {
                throw new AuthenticationException('User not found!!');
            }
            if (!Hash::check($data['password'], $admin->password)) {
                throw new AuthenticationException('Invalid credentials');
            }

            $token = $admin->createToken('admin-token')->plainTextToken;

            return $token;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}


?>