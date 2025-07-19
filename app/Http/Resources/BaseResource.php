<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

/**
 * Class BaseResource
 *
 * Provides a standardized API response structure with common meta blocks.
 * All API resources should extend this class to ensure consistency for meta data.
 *
 * @package App\Http\Resources
 */
class BaseResource extends JsonResource
{
    // Properties to hold dynamic meta data if needed, set via chainable methods
    protected $customStatus = 200;
    protected $customMessage = null;

    /**
     * Set a custom status code for the response.
     *
     * @param int $status
     * @return $this
     */
    public function withStatus(int $status): static
    {
        $this->customStatus = $status;
        return $this;
    }

    /**
     * Set a custom message for the response.
     *
     * @param string $message
     * @return $this
     */
    public function withMessage(string $message): static
    {
        $this->customMessage = $message;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * This method should typically be overridden by child classes
     * to define the 'data' block's structure for the specific model.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        // Default implementation, child resources will override this to define their specific 'data' structure
        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array (the meta block).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        $meta = [
            'timestamp' => Carbon::now()->toIso8601String(), // Use Carbon directly
            'api_version' => config('api.version', 'v1.0.0'),
            'status' => $this->customStatus, // Use dynamic status
            'copyright' => '© 2025 api.advisefy.app. All rights reserved.',
        ];

        // Add message only if it's set
        if ($this->customMessage !== null) {
            $meta['message'] = $this->customMessage;
        }

        return [
            'meta' => $meta,
        ];
    }
}
