<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use App\Traits\InteractsWithResponseMethods;
use App\Traits\HasCommonApiResponses;

/**
 * Class CustomResponse
 *
 * Standardizes API responses with success, error, and meta information.
 * Provides fluent methods for customizing the response payload.
 *
 * @package App\Http\Responses
 */
class CustomResponse implements Responsable
{
    use InteractsWithResponseMethods, HasCommonApiResponses;

    /**
     * @var bool|null Indicates if the response is successful
     */
    protected $success;

    /**
     * @var int|null HTTP status code
     */
    protected $status;

    /**
     * @var string|null Response message
     */
    protected $message;

    /**
     * @var mixed Response data
     */
    protected $data;

    /**
     * @var mixed Response errors
     */
    protected $errors;

    /**
     * @var array|null Meta information for the response
     */
    protected $meta;

    /**
     * Create a successful response instance.
     *
     * @param mixed $data
     * @return static
     */
    public static function success($data = null): self
    {
        $instance = new self();
        $instance->success = true;
        $instance->status = 200;
        $instance->data = $data;
        $instance->errors = null;
        return $instance;
    }

    /**
     * Create an error response instance.
     *
     * @param mixed $errors
     * @return static
     */
    public static function error($errors = null): self
    {
        $instance = new self();
        $instance->success = false;
        $instance->status = 500;
        $instance->data = null;
        $instance->errors = $errors;
        return $instance;
    }

    /**
     * Convert the response to a JSON response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        $response = [
            'success' => $this->success,
            'status' => $this->status,
            'message' => $this->message,
        ];

        // Add data to the response if it's available
        if ($this->data !== null) {
            $response['data'] = $this->data;
        }

        // Add errors to the response if it's available
        if ($this->errors !== null) {
            $response['errors'] = $this->errors;
        }

        // Add meta information to the response
        $response['meta'] = $this->withMeta();

        return response()
            ->json($response, $this->status);
    }
}
