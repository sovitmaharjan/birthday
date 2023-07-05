<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function list($condition = []): User;
    public function store($data): User;
    public function find($condition = []): User;
    public function update($condition = [], $data): bool;
    public function delete($condition = []): bool;
}
