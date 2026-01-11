<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Despawn\StoreDespawnRequest;
use App\Models\Despawn;
use Illuminate\Http\JsonResponse;

class DespawnController extends Controller {

    /**
     * @OA\Post(
     *     path="/api/despawns",
     *     summary="Добавить деспаун пропа",
     *     tags={"Despawns"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"recipient_token","name","location_x","location_y","location_z","tolerance_radius","deliver_at_minutes"},
     *                 @OA\Property(
     *                     property="recipient_token",
     *                     type="string",
     *                     example="player123",
     *                     description="Токен игрока или локации"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="prop_001",
     *                     description="Название пропа для удаления"
     *                 ),
     *                 @OA\Property(
     *                     property="location_x",
     *                     type="number",
     *                     format="float",
     *                     example=10.5,
     *                     description="Координата X"
     *                 ),
     *                 @OA\Property(
     *                     property="location_y",
     *                     type="number",
     *                     format="float",
     *                     example=20.3,
     *                     description="Координата Y"
     *                 ),
     *                 @OA\Property(
     *                     property="location_z",
     *                     type="number",
     *                     format="float",
     *                     example=5.0,
     *                     description="Координата Z"
     *                 ),
     *                 @OA\Property(
     *                     property="tolerance_radius",
     *                     type="number",
     *                     format="float",
     *                     example=2.5,
     *                     description="Радиус погрешности"
     *                 ),
     *                 @OA\Property(
     *                     property="deliver_at_minutes",
     *                     type="integer",
     *                     example=1440,
     *                     description="Время деспауна в минутах"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Despawn created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Despawn")
     *     )
     * )
     */
    public function store(StoreDespawnRequest $request): JsonResponse {
        /** @var Despawn $despawn */
        $despawn = Despawn::query()->create($request->validated());

        return response()->json($despawn, 201);
    }
}
