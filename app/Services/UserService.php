<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function listUsers():LengthAwarePaginator
    {
        return User::query()->where('role','<>','admin')->paginate(20);
    }

    public function approveUser(int $userId):bool
    {
        return User::query()->find($userId)->update([
            'approved'=>true
        ]);
    }

    public function disApproveUser(int $userId):bool
    {
        return User::query()->find($userId)->update([
            'approved'=>false
        ]);
    }

    public function deleteUser(int $userId):bool
    {
        return User::query()->find($userId)->delete();
    }

}
