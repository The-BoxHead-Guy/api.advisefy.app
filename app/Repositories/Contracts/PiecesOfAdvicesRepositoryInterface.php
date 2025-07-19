<?php

namespace App\Repositories\Contracts;

use App\Models\PiecesOfAdvices;

interface PiecesOfAdvicesRepositoryInterface
{
    public function create(array $data): PiecesOfAdvices;
    public function find(int $id): ?PiecesOfAdvices;
}
