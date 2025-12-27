<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
/**
 * @OA\Post(
 * path="/register",
 * summary="Регистрация нового пользователя",
 * tags={"Auth"},
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(
 * required={"login","email","name","password"},
 * @OA\Property(property="login", type="string", example="max123"),
 * @OA\Property(property="email", type="string", format="email", example="user@mail.com"),
 * @OA\Property(property="name", type="string", example="Максим"),
 * @OA\Property(property="password", type="string", format="password", example="secret123")
 * )
 * ),
 * @OA\Response(
 * response=201,
 * description="Успешная регистрация",
 * @OA\JsonContent(
 * @OA\Property(property="token", type="string"),
 * @OA\Property(property="user", type="object")
 * )
 * ),
 * )
 * )
 */
class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user], 201);
    }
}
