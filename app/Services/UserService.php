<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Two\User as GoogleUser;

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

    public function findOrCreateUserByGoogle(GoogleUser $googleUser): void
    {
        $user=User::query()->where('email','=',$googleUser->email)->first();
        if(!$user){
            $user= User::query()->create([
                'name'=>$googleUser->name,
                'email'=>$googleUser->email,
                'password'=>Hash::make(rand(100000,999999))
            ]);
        }
        Auth::login($user);
    }
}
