<?php

namespace App\Http\Controllers\Api;

use App\Actions\SaveGameAction;
use App\Http\Controllers\Controller;
use App\Services\IgdbGameService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request, IgdbGameService $igdbGameService): JsonResponse
    {
        try {
            $page = max(1, (int) $request->query('page', 1));
            $games = $igdbGameService->getAllGames($page, 40);

            return response()->json([
                'success' => true,
                'data' => $games,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los juegos',
            ], 500);
        }
    }

    public function show(string $slug): JsonResponse
    {
        try {
            $game = (new SaveGameAction())($slug);

            if (!$game) {
                return response()->json([
                    'success' => false,
                    'message' => 'Juego no encontrado',
                ], 404);
            }

            $game->load(['genres', 'platforms', 'companies']);

            return response()->json([
                'success' => true,
                'data' => $game,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el juego',
            ], 500);
        }
    }
}