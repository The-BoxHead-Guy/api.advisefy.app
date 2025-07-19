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

    public function find(int $id): ?PiecesOfAdvices
    {
        $this->logInfo('Searching for piece of advice in repository', ['id' => $id]);
        return PiecesOfAdvices::find($id);
    }
}
