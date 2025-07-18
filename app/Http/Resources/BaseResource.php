<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BaseResource
 *
 * Provides a standardized API response structure with meta and data blocks.
 * All API resources should extend this class to ensure consistency.
 *
 * @package App\Http\Resources
 */
class BaseResource extends JsonResource
{
    /**
     * The type of the resource (e.g., 'user', 'piece_of_advice').
     *
     * @var string
     */
    protected $type;

    /**
     * The attributes to be included in the data block.
     *
     * @var array
     */
    protected $attributes;

    /**
     * The ISO 8601 timestamp for the response.
     *
     * @var string
     */
    protected $timestamp;

    /**
     * The API version string.
     *
     * @var string
     */
    protected $apiVersion;

    /**
     * The HTTP status code for the response.
     *
     * @var int
     */
    protected $status;

    /**
     * The copyright string for the response.
     *
     * @var string
     */
    protected $copyright;

    /**
     * The message to be included in the data block.
     *
     * @var string
     */
    protected $message;

    /**
     * BaseResource constructor.
     *
     * @param mixed  $resource   The resource instance.
     * @param string $type       The type of the resource.
     * @param array  $attributes The attributes for the resource.
     * @param string $message    The outcome of the resource.
     * @param string $code    The code of the resource's operation.
     */
    public function __construct($resource, $type, $attributes, $message, $code)
    {
        parent::__construct($resource);

        $this->type = $type;
        $this->attributes = $attributes;
        $this->message = $message;
        $this->status = $code;
    }

    /**
     * Initializes meta properties for the response.
     *
     * @return void
     */
    private function initializeMeta()
    {
        $this->timestamp = now()->toIso8601String();
        $this->apiVersion = config('api.version', 'v1.0.0');
        $this->status = $this->status ?? 200;
        $this->copyright = '© 2025 api.advisefy.app. All rights reserved.';
    }

    /**
     * Transform the resource into an array for JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type'       => $this->type,
                'id'         => $this->resource->id ?? null,
                'message'    => $this->message,
                'attributes' => $this->attributes,
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        $this->initializeMeta();

        return [
            'meta' => [
                'timestamp'   => $this->timestamp,
                'api_version' => $this->apiVersion,
                'status'      => $this->status,
                'copyright'   => $this->copyright,
            ],
        ];
    }
}
