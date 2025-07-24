<?php

namespace App\Traits;

use App\Http\Responses\CustomResponse;

trait CommonApiResponsesTrait
{
    public static function ok(string $message = 'OK', $data = null): CustomResponse
    {
        return CustomResponse::success($data)->withMessage($message)->withCode(200);
    }

    public static function created(string $message = 'Resource created', $data = null): CustomResponse
    {
        return CustomResponse::success($data)->withMessage($message)->withCode(201);
    }

    public static function badRequest(string $message = 'Bad request', $errors = null): CustomResponse
    {
        return CustomResponse::error($errors)->withMessage($message)->withCode(400);
    }

    public static function notFound(string $message = 'Resource not found', $errors = null): CustomResponse
    {
        return CustomResponse::error($errors)->withMessage($message)->withCode(404);
    }

    public static function serverError(string $message = 'Server error', $errors = null): CustomResponse
    {
        return CustomResponse::error($errors)->withMessage($message)->withCode(500);
    }
}
