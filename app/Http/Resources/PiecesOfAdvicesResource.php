<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PiecesOfAdvicesResource extends BaseResource // Extend the new BaseResource
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
            'id' => $this->id,
            'attributes' => [
                'text' => $this->text,
                'author' => $this->author,
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            ],
        ];
    }
}
