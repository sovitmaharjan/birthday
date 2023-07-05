<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
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
        if (request()->upcoming_birthday) {
            $today = Carbon::now()->format('m-d');
            $date = Carbon::now()->addDays(7)->format('m-d');
            $condition['whereRawCondition'][] = "DATE_FORMAT(dob, '%m-%d') BETWEEN '{$today}' AND '{$date}'";
            $condition['sortRawCondition'][] = "DATE_FORMAT(dob, '%m-%d') ASC";
        }
        if (request()->recent_birthday) {
            $today = Carbon::now()->format('m-d');
            $date = Carbon::now()->subDays(7)->format('m-d');
            $condition['whereRawCondition'][] = "DATE_FORMAT(dob, '%m-%d') BETWEEN '{$date}' AND '{$today}'";
            $condition['sortRawCondition'][] = "DATE_FORMAT(dob, '%m-%d') DESC";
        }
        if (!request()->upcoming_birthday && !request()->recent_birthday) {
            $condition['sortCondition'][] = [
                'columnName' => 'updated_at',
                'value' => 'desc',
            ];
        }
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
        $condition['whereCondition'][] = [
            'columnName' => 'id',
            'value' => $identifier,
        ];
        $data['user'] = $this->userRepository->find($condition);
        return view('user.edit', $data);
    }

    public function update(UserUpdateRequest $request, $identifier)
    {
        $condition['whereCondition'][] = [
            'columnName' => 'id',
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
        $condition['whereCondition'][] = [
            'columnName' => 'id',
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
