<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            // paginate para optimizar la carga y devolver los juegos en bloques.
            $games = Game::paginate(15);
            return response()->json([
                'success' => true,
                'data' => $games
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los juegos'
            ], 500);
        }
    }
}