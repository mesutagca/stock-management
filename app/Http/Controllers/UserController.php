<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        if (Auth::user()->role !== 'admin') {
            abort(404);
        }
    }

    public function index(): View
    {
        $users = $this->userService->listUsers();

        return view('user', ['users' => $users]);
    }

    public function destroy(int $userId): RedirectResponse
    {
        $this->userService->deleteUser($userId);
        return redirect()->route('users.index');
    }

    public function approve(int $userId): View
    {
        $this->userService->approveUser($userId);
        return $this->index();
    }

    public function disapprove(int $userId): View
    {
        $this->userService->disApproveUser($userId);
        return $this->index();
    }
}
