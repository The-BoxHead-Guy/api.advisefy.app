<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon; // Ensure Carbon is imported

class PiecesOfAdvicesCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = PiecesOfAdvicesResource::class; // This is correct and crucial!

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meta' => $this->withMetadata(),
            'data' => $this->collection,
        ];
    }

    /**
     * Get additional data that should be included with the resource array.
     * This 'with' method is specific to the collection response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function withMetadata(): array
    {
        // You can have specific meta for the collection
        return [
            'timestamp' => Carbon::now()->toIso8601String(),
            'api_version' => config('api.version', 'v1.0.0'),
            'status' => 200,
            'copyright' => '© 2025 api.advisefy.app. All rights reserved.',
            'message' => 'Excellent, you are now seeing each piece of advice',
        ];
    }
}
