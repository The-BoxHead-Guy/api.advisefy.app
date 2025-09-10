<?php

namespace App\Http\Resources;

use App\Traits\InteractsWithFullResourceMeta;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PiecesOfAdvicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'piece_of_advice',
            'id' => $this->resource->id,
            'attributes' => [
                'text' => $this->resource->text,
                'author' => $this->resource->author,
            ],
        ];
    }
}
