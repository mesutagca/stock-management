<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Http\Responses\RegisterResponse as FortifyRegisterResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterResponse extends FortifyRegisterResponse
{
    protected StatefulGuard $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard=$guard;
    }

    public function toResponse($request): JsonResponse|Response
    {
        $this->guard->logout();

        return redirect()->route('welcome');
    }
}
