<?php

namespace App\Traits;

use App\Http\Responses\CustomResponse;

trait HasCommonApiResponses
{
    public static function ok(string $message = 'OK', $data = null): CustomResponse
    {
        return CustomResponse::success($data)->withMessage($message)->withCode(200);
    }

    public static function created(string $message = 'Resource created', $data = null): CustomResponse
    {
        return CustomResponse::success($data)->withMessage($message)->withCode(201);
    }

    public static function noContent(): CustomResponse
    {
        return CustomResponse::success()->withCode(204);
    }

    public static function badRequest(string $message = 'Bad request', $errors = null): CustomResponse
    {
        return CustomResponse::error($errors)->withMessage($message)->withCode(400);
    }

    public static function notFound(string $message = 'Resource not found', $errors = null): CustomResponse
    {
        return CustomResponse::error($errors)->withMessage($message)->withCode(404);
    }

    public static function unprocessableEntity(string $message = 'Unprocessable entity', $errors = null): CustomResponse
    {
        return CustomResponse::error($errors)->withMessage($message)->withCode(422);
    }

    public static function internalServerError(string $message = 'Internal server error', $errors = null): CustomResponse
    {
        return CustomResponse::error($errors)->withMessage($message)->withCode(500);
    }
}
