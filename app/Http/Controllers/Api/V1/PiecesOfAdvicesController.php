<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePiecesOfAdvicesRequest;
use App\Http\Requests\UpdatePiecesOfAdvicesRequest;
use App\Models\PiecesOfAdvices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class PiecesOfAdvicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('Initializing display of all pieces of advice');
        return Response::json([
            'status' => 'success',
            'message' => 'Excellent, you are now seeing each piece of advice',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePiecesOfAdvicesRequest $request)
    {
        return Response::json([
            'status' => 'success',
            'message' => 'Piece of advice created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PiecesOfAdvices $piecesOfAdvices)
    {
        return Response::json([
            'status' => 'success',
            'message' => 'Piece of advice retrieved successfully',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePiecesOfAdvicesRequest $request, PiecesOfAdvices $piecesOfAdvices)
    {
        return Response::json([
            'status' => 'success',
            'message' => 'Piece of advice updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PiecesOfAdvices $piecesOfAdvices)
    {
        return Response::json([
            'status' => 'success',
            'message' => 'Piece of advice deleted successfully',
        ], 200);
    }
}
