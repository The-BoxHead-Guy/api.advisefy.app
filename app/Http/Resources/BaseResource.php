<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    protected $type;
    protected $attributes;
    protected $timestamp;
    protected $apiVersion;
    protected $status;
    protected $copyright;

    public function __construct($resource, $type, $attributes)
    {
        parent::__construct($resource);
        $this->type = $type;
        $this->attributes = $attributes;
        $this->initializeMeta();
    }

    private function initializeMeta()
    {
        $this->timestamp = now()->toIso8601String();
        $this->apiVersion = config('api.version', 'v1.0.0');
        $this->status = $this->additional['status'] ?? 200;
        $this->copyright = '© ' . now()->year . ' api.dataemergencia.com. All rights reserved.';
    }

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
