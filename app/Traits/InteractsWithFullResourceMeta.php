<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon; // Ensure Carbon is imported

trait InteractsWithFullResourceMeta
{
    /**
     * Properties to hold dynamic meta data that can be set by chainable methods.
     */
    protected int $traitMetaStatus = 200;
    protected ?string $traitMetaMessage = null;

    /**
     * Set a custom status code for the resource's meta block.
     *
     * @param int $status The HTTP status code.
     * @return $this Returns the current resource instance for chaining.
     */
    public function withStatus(int $status): static
    {
        $this->traitMetaStatus = $status;
        return $this;
    }

    /**
     * Set a custom message for the resource's meta block.
     *
     * @param string $message The message string.
     * @return $this Returns the current resource instance for chaining.
     */
    public function withMessage(string $message): static
    {
        $this->traitMetaMessage = $message;
        return $this;
    }

    /**
     * Get additional data that should be returned with the resource array (the meta block).
     * Generates the metadata for resources, collections or responses
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        $currentTime = Carbon::now()->toIso8601String();
        $apiVersion = config('api.version', 'v1.0.0');
        $copyright = '© 2025 api.advisefy.app. All rights reserved.';

        $meta = [
            'timestamp' => $currentTime,
            'api_version' => $apiVersion,
            'copyright' => $copyright,
        ];

        if ($this->traitMetaStatus !== null) {
            $meta['status'] = $this->traitMetaStatus;
        }

        // Add the dynamic message only if it's set
        if ($this->traitMetaMessage !== null) {
            $meta['message'] = $this->traitMetaMessage;
        }

        return [
            'meta' => $meta,
        ];
    }
}
