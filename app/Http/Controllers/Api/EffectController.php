<?php

namespace App\Http\Controllers\Api;

use App\Actions\Effect\ConsumeEffectsAction;
use App\Actions\Effect\GetEffectsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Effect\ConsumeEffectsRequest;
use App\Http\Requests\Effect\StoreEffectRequest;
use App\Http\Requests\Effect\UpdateEffectRequest;
use App\Http\Requests\GenericGetRequest;
use App\Models\Effect;
use Illuminate\Http\JsonResponse;

class EffectController extends Controller {

    /**
     * @OA\Post(
     *     path="/api/effects",
     *     summary="Применить внутриигровой эффект",
     *     tags={"Effects"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"recipient_token","property","value","deliver_at_minutes"},
     *                 @OA\Property(
     *                     property="recipient_token",
     *                     type="string",
     *                     example="player123",
     *                     description="Token игрока"
     *                 ),
     *                 @OA\Property(
     *                     property="property",
     *                     type="string",
     *                     enum={"points","food","health","sleep"},
     *                     example="points",
     *                     description="Свойство, которое будет изменено"
     *                 ),
     *                 @OA\Property(
     *                     property="value",
     *                     type="string",
     *                     example="+50",
     *                     description="Значение (например +10, -5)"
     *                 ),
     *                 @OA\Property(
     *                     property="deliver_at_minutes",
     *                     type="integer",
     *                     example=1440,
     *                     description="Внутриигровое время применения эффекта в минутах"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Effect created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Effect")
     *     )
     * )
     */
    public function store(StoreEffectRequest $request): JsonResponse {
        $effect = Effect::query()->create($request->validated());

        return response()->json($effect, 201);
    }

    /**
     * @OA\Patch(
     *     path="/api/effects/{effect}",
     *     summary="Обновить внутриигровой эффект",
     *     tags={"Effects"},
     *     @OA\Parameter(
     *         name="effect",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID эффекта"
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
     *                     description="Token игрока"
     *                 ),
     *                 @OA\Property(
     *                     property="property",
     *                     type="string",
     *                     enum={"points","food","health","sleep"},
     *                     example="points",
     *                     description="Свойство, которое будет изменено"
     *                 ),
     *                 @OA\Property(
     *                     property="value",
     *                     type="string",
     *                     example="+50",
     *                     description="Значение (например +10, -5)"
     *                 ),
     *                 @OA\Property(
     *                     property="deliver_at_minutes",
     *                     type="integer",
     *                     example=1440,
     *                     description="Внутриигровое время применения эффекта в минутах"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Effect updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Effect")
     *     ),
     *     @OA\Response(response=404, description="Effect not found")
     * )
     */
    public function update(UpdateEffectRequest $request, Effect $effect): JsonResponse {
        $effect->update($request->validated());

        return response()->json($effect);
    }

    /**
     * @OA\Delete(
     *     path="/api/effects/{effect}",
     *     summary="Удалить внутриигровой эффект",
     *     tags={"Effects"},
     *     @OA\Parameter(
     *         name="effect",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID эффекта"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Effect deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Effect not found")
     * )
     */
    public function destroy(Effect $effect): JsonResponse {
        $effect->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/effects",
     *     summary="Получить все внутриигровые эффекты",
     *     tags={"Effects"},
     *     @OA\Parameter(
     *         name="recipient_token",
     *         in="query",
     *         required=true,
     *         description="Token игрока",
     *         @OA\Schema(type="string", example="player123")
     *     ),
     *     @OA\Parameter(
     *         name="current_minutes",
     *         in="query",
     *         required=false,
     *         description="Текущее внутриигровое время в минутах",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список эффектов игрока",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Effect"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="recipient_token не передан"
     *     )
     * )
     */
    public function index(GenericGetRequest $request, GetEffectsAction $action): JsonResponse {
        $effects = $action(
            $request->input('recipient_token'),
            $request->input('current_minutes')
        );

        return response()->json($effects);
    }

    /**
     * @OA\Post(
     *     path="/api/effects/consume",
     *     summary="Получить новые внутриигровые эффекты и пометить их примененными",
     *     tags={"Effects"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"recipient_token","current_minutes"},
     *                 @OA\Property(
     *                     property="recipient_token",
     *                     type="string",
     *                     example="player123",
     *                     description="Токен игрока"
     *                 ),
     *                 @OA\Property(
     *                     property="current_minutes",
     *                     type="integer",
     *                     example=1440,
     *                     description="Текущее игровое время в минутах"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список новых внутриигровых эффектов, помеченных как примененные",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Effect"))
     *     )
     * )
     */
    public function consume(ConsumeEffectsRequest $request, ConsumeEffectsAction $consumeEffectsAction): JsonResponse {
        $effects = $consumeEffectsAction(
            $request->input('recipient_token'),
            $request->input('current_minutes')
        );

        return response()->json($effects);
    }
}
