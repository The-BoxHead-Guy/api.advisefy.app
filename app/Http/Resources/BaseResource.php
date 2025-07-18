<?php

namespace App\Http\Resources;

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
     * BaseResource constructor.
     *
     * @param mixed  $resource   The resource instance.
     * @param string $type       The type of the resource.
     * @param array  $attributes The attributes for the resource.
     */
    public function __construct($resource, $type, $attributes)
    {
        parent::__construct($resource);
        $this->type = $type;
        $this->attributes = $attributes;
        $this->initializeMeta();
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
        $this->status = $this->additional['status'] ?? 200;
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
            'meta' => [
                'timestamp'   => $this->timestamp,
                'api_version' => $this->apiVersion,
                'status'      => $this->status,
                'copyright'   => $this->copyright,
            ],
            'data' => [
                'type'       => $this->type,
                'id'         => $this->resource->id ?? null,
                'attributes' => $this->attributes,
            ],
        ];
    }
}
