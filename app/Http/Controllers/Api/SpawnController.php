<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Spawn\StoreSpawnRequest;
use App\Models\Spawn;
use Illuminate\Http\JsonResponse;

class SpawnController extends Controller {

    /**
     * @OA\Post(
     *     path="/api/spawns",
     *     summary="Добавить спаун пропа",
     *     tags={"Spawns"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"recipient_token","name","deliver_at_minutes"},
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
     *                     description="Название пропа для спауна"
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
     *                     property="rotation_x",
     *                     type="number",
     *                     format="float",
     *                     example=0,
     *                     description="Вращение по X"
     *                 ),
     *                 @OA\Property(
     *                     property="rotation_y",
     *                     type="number",
     *                     format="float",
     *                     example=90,
     *                     description="Вращение по Y"
     *                 ),
     *                 @OA\Property(
     *                     property="rotation_z",
     *                     type="number",
     *                     format="float",
     *                     example=0,
     *                     description="Вращение по Z"
     *                 ),
     *                 @OA\Property(
     *                     property="scale_x",
     *                     type="number",
     *                     format="float",
     *                     example=1.0,
     *                     description="Масштаб по X"
     *                 ),
     *                 @OA\Property(
     *                     property="scale_y",
     *                     type="number",
     *                     format="float",
     *                     example=1.0,
     *                     description="Масштаб по Y"
     *                 ),
     *                 @OA\Property(
     *                     property="scale_z",
     *                     type="number",
     *                     format="float",
     *                     example=1.0,
     *                     description="Масштаб по Z"
     *                 ),
     *                 @OA\Property(
     *                     property="deliver_at_minutes",
     *                     type="integer",
     *                     example=1440,
     *                     description="Время спауна в минутах"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Spawn created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Spawn")
     *     )
     * )
     */
    public function store(StoreSpawnRequest $request): JsonResponse {
        /** @var Spawn $spawn */
        $spawn = Spawn::query()->create($request->validated());

        return response()->json($spawn, 201);
    }
}
