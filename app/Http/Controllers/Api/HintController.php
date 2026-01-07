<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hint\StoreHintRequest;
use App\Models\Hint;
use Illuminate\Http\JsonResponse;

class HintController extends Controller {

    /**
     * @OA\Post(
     *     path="/api/hints",
     *     summary="Добавить всплывающее уведомление (hint)",
     *     tags={"Hints"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"recipient_token","type","text","deliver_at_minutes"},
     *                 @OA\Property(
     *                     property="recipient_token",
     *                     type="string",
     *                     example="player123",
     *                     description="Token игрока, получателя уведомления"
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     enum={"info","warning","error","thought"},
     *                     example="info",
     *                     description="Тип всплывающего уведомления"
     *                 ),
     *                 @OA\Property(
     *                     property="text",
     *                     type="string",
     *                     example="You have a new mission",
     *                     description="Текст уведомления"
     *                 ),
     *                 @OA\Property(
     *                     property="deliver_at_minutes",
     *                     type="integer",
     *                     example=1440,
     *                     description="Внутриигровое время доставки в минутах"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Hint created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Hint")
     *     )
     * )
     */
    public function store(StoreHintRequest $request): JsonResponse {
        /** @var Hint $hint */
        $hint = Hint::query()->create($request->validated());

        return response()->json($hint, 201);
    }
}
