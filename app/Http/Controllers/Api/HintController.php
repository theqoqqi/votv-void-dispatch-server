<?php

namespace App\Http\Controllers\Api;

use App\Actions\Hint\GetHintsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenericGetRequest;
use App\Http\Requests\Hint\StoreHintRequest;
use App\Http\Requests\Hint\UpdateHintRequest;
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

    /**
     * @OA\Patch(
     *     path="/api/hints/{hint}",
     *     summary="Обновить всплывающее уведомление (hint)",
     *     tags={"Hints"},
     *     @OA\Parameter(
     *         name="hint",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID уведомления"
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
     *         response=200,
     *         description="Hint updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Hint")
     *     ),
     *     @OA\Response(response=404, description="Hint not found")
     * )
     */
    public function update(UpdateHintRequest $request, Hint $hint): JsonResponse {
        $hint->update($request->validated());

        return response()->json($hint);
    }

    /**
     * @OA\Delete(
     *     path="/api/hints/{hint}",
     *     summary="Удалить всплывающее уведомление (hint)",
     *     tags={"Hints"},
     *     @OA\Parameter(
     *         name="hint",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID уведомления"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Hint deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Hint not found")
     * )
     */
    public function destroy(Hint $hint): JsonResponse {
        $hint->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/hints",
     *     summary="Получить все всплывающие уведомления (hints) игрока",
     *     tags={"Hints"},
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
     *         description="Список уведомлений игрока",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Hint"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="recipient_token не передан"
     *     )
     * )
     */
    public function index(GenericGetRequest $request, GetHintsAction $action): JsonResponse {
        $hints = $action(
            $request->input('recipient_token'),
            $request->input('current_minutes')
        );

        return response()->json($hints);
    }
}
