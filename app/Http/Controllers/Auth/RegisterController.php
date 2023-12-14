<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;



class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {

        return new UserResource($request->persist());
    }
}
