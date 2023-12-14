<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function __invoke(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    $TOKEN_KEY = config('app.token_key', 'myAppToken');

    if (Auth::attempt($credentials)) {
      $user = User::query()->with(['business'])->find(Auth::id());
      
      return response()->json([
        'token' => $user->createToken($TOKEN_KEY)->plainTextToken,
        'user' => $user,
      ]);

    }

    return response()->json([
      'message' => 'Your credential does not match.',
    ], 401);
  }
}
