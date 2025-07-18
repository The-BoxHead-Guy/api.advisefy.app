<?php

namespace App\Http\Resources;

class PiecesOfAdvicesResource extends BaseResource
{
    public function __construct($resource)
    {
        parent::__construct(
            $resource,
            'piece_of_advice',
            [
                'text'   => $resource->text,
                'author' => $resource->author,
            ]
        );
    }
}
