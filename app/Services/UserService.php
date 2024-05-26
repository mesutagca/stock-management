<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function listUsers():LengthAwarePaginator
    {
        return User::paginate(2);
    }

}
