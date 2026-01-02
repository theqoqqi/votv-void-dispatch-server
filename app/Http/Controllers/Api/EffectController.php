<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEffectRequest;
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
}
