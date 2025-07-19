<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PiecesOfAdvicesCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'type' => 'piece_of_advice',
                    'id' => $item->id,
                    'attributes' => [
                        'text' => $item->text,
                        'author' => $item->author,
                    ],
                ];
            }),
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'timestamp' => now()->toIso8601String(),
                'api_version' => config('api.version', 'v1.0.0'),
                'status' => 200,
                'copyright' => '© 2025 api.advisefy.app. All rights reserved.',
                'message' => 'Excellent, you are now seeing each piece of advice',
            ],
        ];
    }
}
