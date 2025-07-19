<?php

namespace App\Services;

use App\Repositories\Contracts\PiecesOfAdvicesRepositoryInterface;
use App\Traits\Logger;
use App\Exceptions\PiecesOfAdviceException;
use Illuminate\Support\Facades\DB;
use Exception;

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
        $this->logInfo('Starting transaction for creating piece of advice', $data);

        try {
            DB::beginTransaction();

            $this->logInfo('Delegating creation to repository', $data);
            $pieceOfAdvice = $this->repository->create($data);

            DB::commit();
            $this->logInfo('Transaction committed successfully for piece of advice creation', ['id' => $pieceOfAdvice->id]);

            return $pieceOfAdvice;
        } catch (Exception $e) {
            DB::rollBack();
            $this->logError('Transaction rolled back for piece of advice creation', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
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

    public function update(int $id, array $data)
    {
        $this->logInfo('Starting transaction for updating piece of advice', ['id' => $id, 'data' => $data]);

        try {
            DB::beginTransaction();

            $this->logInfo('Attempting to update piece of advice', ['id' => $id, 'data' => $data]);
            $pieceOfAdvice = $this->repository->update($id, $data);

            if (!$pieceOfAdvice) {
                throw new PiecesOfAdviceException("Piece of advice with ID {$id} not found", 404);
            }

            DB::commit();
            $this->logInfo('Transaction committed successfully for piece of advice update', ['id' => $id]);

            return $pieceOfAdvice;
        } catch (PiecesOfAdviceException $e) {
            DB::rollBack();
            $this->logError('Transaction rolled back for piece of advice update - not found', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            $this->logError('Transaction rolled back for piece of advice update - unexpected error', [
                'id' => $id,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function destroy(int $id)
    {
        $this->logInfo('Starting transaction for deleting piece of advice', ['id' => $id]);

        try {
            DB::beginTransaction();

            $this->logInfo('Attempting to find piece of advice before deletion', ['id' => $id]);

            $pieceOfAdvice = $this->repository->find($id);
            if (!$pieceOfAdvice) {
                throw new PiecesOfAdviceException("Piece of advice with ID {$id} not found", 404);
            }

            $deleted = $this->repository->destroy($id);
            if (!$deleted) {
                throw new PiecesOfAdviceException("Failed to delete piece of advice with ID {$id}", 500);
            }

            DB::commit();

            $this->logInfo('Transaction committed successfully for piece of advice deletion', ['id' => $id]);
            return true;
        } catch (PiecesOfAdviceException $e) {
            DB::rollBack();
            $this->logError('Transaction rolled back for piece of advice deletion - not found or failed', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            $this->logError('Transaction rolled back for piece of advice deletion - unexpected error', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
