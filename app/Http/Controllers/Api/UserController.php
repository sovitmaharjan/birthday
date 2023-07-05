<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use Exception;

class UserController extends Controller
{
    protected $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;    
    }

    public function destroy($identifier)
    {
        $condition['where_condition'][] = [
            'column_name' => 'id',
            'value' => $identifier,
        ];
        try {
            $this->userRepository->destroy($condition);
            return responseSuccessMsg('User has been deleted.', 200);
        } catch (Exception $e) {
            return responseError($e->getMessage());
        }
    }
}
