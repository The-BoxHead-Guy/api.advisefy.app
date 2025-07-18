<?php

namespace App\Repositories;

use App\Models\PiecesOfAdvices;
use App\Repositories\Contracts\PiecesOfAdvicesRepositoryInterface;
use App\Traits\Logger;

class PiecesOfAdvicesRepository implements PiecesOfAdvicesRepositoryInterface
{
    use Logger;

    public function create(array $data): PiecesOfAdvices
    {
        $this->logInfo('Creating new piece of advice in repository', $data);
        return PiecesOfAdvices::create($data);
    }
}
