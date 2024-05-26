<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }

    public function index(): View
    {
        if (Auth::user()->role !== 'admin') {
            abort(404);
        }

        $users = $this->userService->listUsers();
//dd($users->lastPage());
        return view('user', ['users' => $users]);
    }
}
