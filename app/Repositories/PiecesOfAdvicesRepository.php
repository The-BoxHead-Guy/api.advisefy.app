<?php

namespace App\Repositories;

use App\Models\PiecesOfAdvices;
use App\Repositories\Contracts\PiecesOfAdvicesRepositoryInterface;
use App\Traits\Logger;
use Illuminate\Support\Collection;

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

    public function update(int $id, array $data): ?PiecesOfAdvices
    {
        $this->logInfo('Updating piece of advice in repository', ['id' => $id, 'data' => $data]);

        $pieceOfAdvice = $this->find($id);

        if ($pieceOfAdvice) {
            $pieceOfAdvice->update($data);
            $this->logInfo('Piece of advice updated successfully in repository', ['id' => $id]);
        }

        return $pieceOfAdvice;
    }

    public function destroy(int $id): bool
    {
        $this->logInfo('Attempting to delete piece of advice in repository', ['id' => $id]);

        $pieceOfAdvice = $this->find($id);

        if ($pieceOfAdvice) {
            $this->logInfo('Piece of advice deleted successfully in repository', ['id' => $id]);
            return $pieceOfAdvice->delete();
        }

        $this->logWarning('Piece of advice not found for deletion in repository', ['id' => $id]);
        return false;
    }

    public function all(): Collection|array
    {
        $this->logInfo('Fetching all pieces of advice from repository');
        return PiecesOfAdvices::all();
    }

    public function existsByContent(string $text): bool
    {
        return PiecesOfAdvices::where('text', $text)->exists();
    }
}
