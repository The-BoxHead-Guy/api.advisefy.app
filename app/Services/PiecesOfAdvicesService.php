<?php

namespace App\Services;

use App\Repositories\Contracts\PiecesOfAdvicesRepositoryInterface;
use App\Traits\Logger;
use App\Exceptions\PiecesOfAdviceException;

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

    public function find(int $id)
    {
        $this->logInfo('Attempting to find piece of advice', ['id' => $id]);
        $pieceOfAdvice = $this->repository->find($id);

        if (!$pieceOfAdvice) {
            throw new PiecesOfAdviceException("Piece of advice with ID {$id} not found", 404);
        }

        $this->logInfo('Piece of advice found successfully', ['id' => $id]);
        return $pieceOfAdvice;
    }
}
