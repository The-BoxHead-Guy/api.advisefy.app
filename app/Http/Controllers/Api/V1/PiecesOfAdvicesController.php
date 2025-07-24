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
use App\Http\Responses\CustomResponse;

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
            return CustomResponse::ok(
                'Pieces of advice fetched successfully',
                new PiecesOfAdvicesCollection($piecesOfAdvices)
            );
        } catch (Exception $e) {
            $this->logError('Unexpected error during fetching all pieces of advice', [
                'error' => $e->getMessage()
            ]);
            return CustomResponse::internalServerError(
                'An unexpected error occurred while fetching the pieces of advice.',
                ['code' => "SERVER_ERROR", 'message' => $e->getMessage()]
            );
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

            return CustomResponse::created(
                'Piece of advice created successfully',
                new PiecesOfAdvicesResource($pieceOfAdvice)
            );
        } catch (PiecesOfAdviceException $e) {
            $this->logError(
                'Business logic error during piece of advice creation',
                ['error' => $e->getMessage(), 'data ' => $data]
            );
            return CustomResponse::error([
                'code' => 'PIECES_OF_ADVICE_ERROR',
                'message' => $e->getMessage(),
            ])->withMessage($e->getMessage())->withCode($e->getCode());
        } catch (Exception $e) {
            $this->logError(
                'Unexpected error during piece of advice creation',
                ['error' => $e->getMessage(), 'data' => $data]
            );
            return CustomResponse::internalServerError(
                'An unexpected error occurred while creating the piece of advice.',
                ['code' => "SERVER_ERROR", 'message' => $e->getMessage()]
            );
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

            return CustomResponse::ok(
                'Piece of advice retrieved successfully',
                new PiecesOfAdvicesResource($pieceOfAdvice)
            );
        } catch (PiecesOfAdviceException $e) {
            $this->logError(
                'Piece of advice not found',
                ['id' => $id, 'error ' => $e->getMessage()]
            );
            return CustomResponse::error([
                'code' => 'PIECES_OF_ADVICE_ERROR',
                'message' => $e->getMessage(),
            ])->withMessage($e->getMessage())->withCode($e->getCode());
        } catch (Exception $e) {
            $this->logError(
                'Unexpected error during piece of advice retrieval',
                ['id' => $id, 'error' => $e->getMessage()]
            );
            return CustomResponse::internalServerError(
                'An unexpected error occurred while retrieving the piece of advice.',
                ['code' => "SERVER_ERROR", 'message' => $e->getMessage()]
            );
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
                ['id' => $id, 'error' => $e->getMessage(), 'data ' => $data]
            );
            return CustomResponse::error([
                'code' => 'PIECES_OF_ADVICE_ERROR',
                'message' => $e->getMessage(),
            ])->withMessage($e->getMessage())->withCode($e->getCode());
        } catch (Exception $e) {
            $this->logError(
                'Unexpected error during piece of advice update',
                ['id' => $id, 'error' => $e->getMessage(), 'data' => $data]
            );
            return CustomResponse::internalServerError(
                'An unexpected error occurred while updating the piece of advice.',
                ['code' => "SERVER_ERROR", 'message' => $e->getMessage()]
            );
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
                'error ' => $e->getMessage()
            ]);
            return CustomResponse::error([
                'code' => 'PIECES_OF_ADVICE_ERROR',
                'message' => $e->getMessage(),
            ])->withMessage($e->getMessage())->withCode($e->getCode());
        } catch (Exception $e) {
            $this->logCritical('Unexpected error during piece of advice deletion', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return CustomResponse::internalServerError(
                'An unexpected error occurred while creating the piece of advice.',
                ['code' => "SERVER_ERROR", 'message' => $e->getMessage()]
            );
        }
    }
}
