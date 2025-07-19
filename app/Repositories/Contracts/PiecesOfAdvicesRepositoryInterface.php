<?php

namespace App\Repositories\Contracts;

use App\Models\PiecesOfAdvices;

interface PiecesOfAdvicesRepositoryInterface
{
    public function create(array $data): PiecesOfAdvices;
    public function find(int $id): ?PiecesOfAdvices;
    public function update(int $id, array $data): ?PiecesOfAdvices;
    public function destroy(int $id): bool;
}
