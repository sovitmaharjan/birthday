<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;    
    }

    public function list($condition = []): User
    {
        $model = $this->user;
        if (count($condition) > 0) {
            $model = queryFilter($model, $condition);
        }
        return (isset($condition['paginate']) && $condition['paginate'] == 1) ? $model->paginate($condition['limit'] ?? 10) : $model->get();
    }

    public function store($data): User
    {
        return User::create($data);
    }

    public function find($condition = []): User
    {
        $model = queryFilter($this->user, $condition);
        return $model->firstOrFail();
    }

    public function update($condition = [], $data): bool
    {
        $model = $this->find($condition);
        return $model->update($data);
    }

    public function delete($condition = []): bool
    {
        $model = $this->find($condition);
        return $model->delete();
    }
}
