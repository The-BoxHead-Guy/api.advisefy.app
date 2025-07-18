<?php

namespace App\Services;

use App\Repositories\Contracts\PiecesOfAdvicesRepositoryInterface;
use App\Traits\Logger;

class PiecesOfAdvicesService
{
    use Logger;

    protected $repository;

    public function __construct(PiecesOfAdvicesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        $this->logInfo('Delegating creation to repository', $data);
        return $this->repository->create($data);
    }
}
