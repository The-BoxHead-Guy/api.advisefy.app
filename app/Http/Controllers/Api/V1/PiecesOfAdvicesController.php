<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Traits\Logger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PiecesOfAdvicesService;
use Illuminate\Support\Facades\Response;
use App\Exceptions\PiecesOfAdviceException;
use App\Http\Resources\PiecesOfAdvicesResource;
use App\Http\Resources\PiecesOfAdvicesCollection;
use App\Http\Requests\StorePiecesOfAdvicesRequest;
use App\Http\Requests\UpdatePiecesOfAdvicesRequest;

class PiecesOfAdvicesController extends Controller
{
    use Logger;

    protected $service;

    public function __construct(PiecesOfAdvicesService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->logInfo('Initializing display of all pieces of advice');

        try {
            $piecesOfAdvices = $this->service->all();
            return (new PiecesOfAdvicesCollection($piecesOfAdvices))
                ->withMessage('Pieces of advice fetched successfully');
        } catch (Exception $e) {
            $this->logError('Unexpected error during fetching all pieces of advice', [
                'error' => $e->getMessage()
            ]);
            return Response::json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while fetching the pieces of advice.',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePiecesOfAdvicesRequest $request)
    {
        $data = $request->validated();
        $this->logInfo('Received request to create piece of advice', $data);

        try {
            $pieceOfAdvice = $this->service->create($data);
            $this->logInfo('Piece of advice created successfully', ['id' => $pieceOfAdvice->id]);

            return (new PiecesOfAdvicesResource(
                $pieceOfAdvice
            ))
                ->withMessage('Piece of advice created successfully');
        } catch (PiecesOfAdviceException $e) {
            $this->logError(
                'Business logic error during piece of advice creation',
                ['error' => $e->getMessage(), 'data' => $data]
            );
            return Response::json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch (Exception $e) {
            $this->logError(
                'Unexpected error during piece of advice creation',
                ['error' => $e->getMessage(), 'data' => $data]
            );
            return Response::json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while creating the piece of advice.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id)
    {
        $this->logInfo('Received request to show piece of advice');

        try {
            $pieceOfAdvice = $this->service->find($id);
            $this->logInfo('Piece of advice retrieved successfully', ['id' => $id]);

            return (new PiecesOfAdvicesResource($pieceOfAdvice))
                ->withMessage('Piece of advice retrieved successfully');
        } catch (PiecesOfAdviceException $e) {
            $this->logError(
                'Piece of advice not found',
                ['id' => $id, 'error' => $e->getMessage()]
            );
            return Response::json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch (Exception $e) {
            $this->logError(
                'Unexpected error during piece of advice retrieval',
                ['id' => $id, 'error' => $e->getMessage()]
            );
            return Response::json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while retrieving the piece of advice.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePiecesOfAdvicesRequest $request, int $id)
    {
        $data = $request->validated();
        $this->logInfo('Received request to update piece of advice', ['id' => $id, 'data' => $data]);

        try {
            $pieceOfAdvice = $this->service->update($id, $data);
            $this->logInfo('Piece of advice updated successfully', ['id' => $id]);

            return (new PiecesOfAdvicesResource($pieceOfAdvice))
                ->withMessage('Piece of advice updated successfully');
        } catch (PiecesOfAdviceException $e) {
            $this->logError(
                'Business logic error during piece of advice update',
                ['id' => $id, 'error' => $e->getMessage(), 'data' => $data]
            );
            return Response::json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch (Exception $e) {
            $this->logError(
                'Unexpected error during piece of advice update',
                ['id' => $id, 'error' => $e->getMessage(), 'data' => $data]
            );
            return Response::json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while updating the piece of advice.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        $this->logInfo('Received request to delete piece of advice', ['id' => $id]);

        try {
            $this->service->destroy($id);
            $this->logInfo('Piece of advice deleted successfully', ['id' => $id]);

            return Response::json([
                'status' => 'success',
                'message' => 'Piece of advice deleted successfully',
            ], 200);
        } catch (PiecesOfAdviceException $e) {
            $this->logError('Business logic error during piece of advice deletion', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return Response::json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch (Exception $e) {
            $this->logCritical('Unexpected error during piece of advice deletion', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return Response::json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while deleting the piece of advice.',
            ], 500);
        }
    }
}
