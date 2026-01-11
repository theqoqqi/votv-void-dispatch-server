<?php

namespace App\Http\Controllers\Api;

use App\Actions\Despawn\GetDespawnsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Despawn\StoreDespawnRequest;
use App\Http\Requests\Despawn\UpdateDespawnRequest;
use App\Http\Requests\GenericGetRequest;
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

    /**
     * @OA\Patch(
     *     path="/api/despawns/{despawn}",
     *     summary="Обновить деспаун пропа",
     *     tags={"Despawns"},
     *     @OA\Parameter(
     *         name="despawn",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID деспауна"
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
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
     *         response=200,
     *         description="Despawn updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Despawn")
     *     ),
     *     @OA\Response(response=404, description="Despawn not found")
     * )
     */
    public function update(UpdateDespawnRequest $request, Despawn $despawn): JsonResponse {
        $despawn->update($request->validated());

        return response()->json($despawn);
    }

    /**
     * @OA\Delete(
     *     path="/api/despawns/{despawn}",
     *     summary="Удалить деспаун пропа",
     *     tags={"Despawns"},
     *     @OA\Parameter(
     *         name="despawn",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID деспауна"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Despawn deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Despawn not found")
     * )
     */
    public function destroy(Despawn $despawn): JsonResponse {
        $despawn->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/despawns",
     *     summary="Получить все деспауны пропов",
     *     tags={"Despawns"},
     *     @OA\Parameter(
     *         name="recipient_token",
     *         in="query",
     *         required=true,
     *         description="Токен игрока или локации",
     *         @OA\Schema(type="string", example="player123")
     *     ),
     *     @OA\Parameter(
     *         name="current_minutes",
     *         in="query",
     *         required=false,
     *         description="Текущее игровое время в минутах",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список деспаунов",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Despawn"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="recipient_token не передан"
     *     )
     * )
     */
    public function index(GenericGetRequest $request, GetDespawnsAction $action): JsonResponse {
        $despawns = $action(
            $request->input('recipient_token'),
            $request->input('current_minutes')
        );

        return response()->json($despawns);
    }
}
