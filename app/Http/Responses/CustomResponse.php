<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use App\Traits\InteractsWithResponseMethods;
use App\Traits\HasCommonApiResponses;

class CustomResponse implements Responsable
{
    use InteractsWithResponseMethods, HasCommonApiResponses;

    protected $success;
    protected $status;
    protected $message;
    protected $data;
    protected $errors;
    protected $meta;

    public static function success($data = null): self
    {
        $instance = new self();
        $instance->success = true;
        $instance->status = 200;
        $instance->data = $data;
        $instance->errors = null;
        return $instance;
    }

    public static function error($errors = null): self
    {
        $instance = new self();
        $instance->success = false;
        $instance->status = 500;
        $instance->data = null;
        $instance->errors = $errors;
        return $instance;
    }

    public function toResponse($request)
    {
        $response = [
            'success' => $this->success,
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors,
            'meta' => $this->withMeta(),
        ];
        return response()->json($response, $this->status);
    }
}
