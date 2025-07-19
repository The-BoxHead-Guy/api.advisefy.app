<?php

namespace App\Http\Resources;

use App\Traits\InteractsWithFullResourceMeta;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PiecesOfAdvicesCollection extends ResourceCollection
{
    use InteractsWithFullResourceMeta;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
