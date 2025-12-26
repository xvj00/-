<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Post(
 * path="/login",
 * summary="Вход в систему",
 * tags={"Auth"},
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(
 * required={"email","password"},
 * @OA\Property(property="login", type="string", format="login", example="max123"),
 * @OA\Property(property="password", type="string", format="password", example="secret123")
 * )
 * ),
 * @OA\Response(
 * response=200,
 * description="Успешный вход",
 * @OA\JsonContent(
 * @OA\Property(property="token", type="string", example="1|abc123token"),
 * @OA\Property(property="user", type="object")
 * )
 * ),
 * @OA\Response(response=401, description="Неверные данные")
 * )
 */
class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => Auth::user()], 201);
        }
        return response()->json(['error' => 'Неправильный логин или пароль'], 401);
    }


    /**
     * @OA\Post(
     * path="/logout",
     * summary="Выход из системы",
     * tags={"Auth"},
     * security={{"apiAuth":{}}},
     * @OA\Response(response=200, description="Вы успешно вышли"),
     * @OA\Response(response=401, description="Токен недействителен или отсутствует")
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Вы успешно вышли из системы'], 200);
    }
}
