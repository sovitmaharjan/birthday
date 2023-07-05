<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\UserRepositoryInterface;
use Exception;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $condition['sort_condition'][] = [
            'column_name' => 'updated_at',
            'value' => 'desc',
        ];
        $data['users'] = $this->userRepository->list($condition);
        return view('user.index', $data);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $this->userRepository->store($request->validated());
            return back()->with('success', 'User has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($identifier)
    {
        $condition['where_condition'][] = [
            'column_name' => 'id',
            'value' => $identifier,
        ];
        $data['user'] = $this->userRepository->find($condition);
        return view('user.edit', $data);
    }

    public function update(UserUpdateRequest $request, $identifier)
    {
        $condition['where_condition'][] = [
            'column_name' => 'id',
            'value' => $identifier,
        ];
        try {
            $this->userRepository->update($request->validated(), $condition);
            return back()->with('success', 'User has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($identifier)
    {
        $condition['where_condition'][] = [
            'column_name' => 'id',
            'value' => $identifier,
        ];
        try {
            $this->userRepository->destroy($condition);
            return back()->with('success', 'User has been deleted');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
