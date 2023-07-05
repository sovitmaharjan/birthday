<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function list($condition = []): Collection;
    public function store($data): User;
    public function find($condition = []): User;
    public function update($data, $condition = []): bool;
    public function destroy($condition = []): bool;
}
