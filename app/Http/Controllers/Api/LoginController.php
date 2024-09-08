<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken($request->token_name);

            return response()->json(['token' => $token->plainTextToken]
            , 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
