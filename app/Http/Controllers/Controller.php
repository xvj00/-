<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 * title="My Laravel API",
 * version="1.0.0",
 * description="Документация для моей Афиши"
 * )
 * @OA\Server(
 * url="http://127.0.0.1:8000/api",
 * description="Локальный сервер"
 * ),
 *
 * @OA\SecurityScheme(
 *  type="http",
 *  scheme="bearer",
 *  bearerFormat="JWT",
 *  securityScheme="apiAuth",
 *  description="Введите ваш токен Sanctum в поле ниже"
 *  ),
 *
 *
 */
abstract class Controller
{
    //
}
