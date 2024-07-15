<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;
    
    public function getAllUsers()
    {
        try {
            $userList = User::query()->get();
            
            return $this->successResponse($userList, 200, 'Get the user list successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('500', $e->getMessage());
        }
    }
}
