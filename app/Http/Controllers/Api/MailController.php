<?php

namespace App\Http\Controllers\Api;

use App\Actions\Mail\ConsumeMailsAction;
use App\Actions\Mail\GetMailsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsumeMailsRequest;
use App\Http\Requests\GetMailsRequest;
use App\Http\Requests\StoreMailRequest;
use App\Http\Requests\UpdateMailRequest;
use App\Models\Mail;
use Illuminate\Http\JsonResponse;

class MailController extends Controller {

    /**
     * @OA\Post(
     *     path="/api/mails",
     *     summary="Добавить письмо",
     *     tags={"Mails"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"recipient_token","sender","subject","body","deliver_at_minutes"},
     *                 @OA\Property(
     *                     property="recipient_token",
     *                     type="string",
     *                     example="player123",
     *                     description="Token игрока, получателя письма"
     *                 ),
     *                 @OA\Property(
     *                     property="sender",
     *                     type="string",
     *                     enum={
     *                         "Dr_Bao",
     *                         "Prof_Lea",
     *                         "Auto",
     *                         "Dr_Max",
     *                         "Dr_Ken",
     *                         "Dr_Ena",
     *                         "Dr_Ula",
     *                         "Dr_Ler",
     *                         "user",
     *                         "Dr_Noa"
     *                     },
     *                     example="Dr_Bao",
     *                     description="Отправитель письма"
     *                 ),
     *                 @OA\Property(
     *                     property="subject",
     *                     type="string",
     *                     example="Your mission",
     *                     description="Заголовок письма"
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                     example="Collect 10 samples",
     *                     description="Содержимое письма"
     *                 ),
     *                 @OA\Property(
     *                     property="deliver_at_minutes",
     *                     type="integer",
     *                     example=1440,
     *                     description="Внутриигровое время доставки письма в минутах"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Mail created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Mail")
     *     )
     * )
     */
    public function store(StoreMailRequest $request): JsonResponse {
        /** @var $mail Mail */
        $mail = Mail::query()->create($request->validated());

        return response()->json($mail, 201);
    }

    /**
     * @OA\Patch(
     *     path="/api/mails/{mail}",
     *     summary="Обновить письмо",
     *     tags={"Mails"},
     *     @OA\Parameter(
     *         name="mail",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID письма"
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
     *                     description="Token игрока, получателя письма"
     *                 ),
     *                 @OA\Property(
     *                     property="sender",
     *                     type="string",
     *                     enum={
     *                         "Dr_Bao",
     *                         "Prof_Lea",
     *                         "Auto",
     *                         "Dr_Max",
     *                         "Dr_Ken",
     *                         "Dr_Ena",
     *                         "Dr_Ula",
     *                         "Dr_Ler",
     *                         "user",
     *                         "Dr_Noa"
     *                     },
     *                     example="Dr_Bao",
     *                     description="Отправитель письма"
     *                 ),
     *                 @OA\Property(
     *                     property="subject",
     *                     type="string",
     *                     example="Your mission",
     *                     description="Заголовок письма"
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                     example="Collect 10 samples",
     *                     description="Содержимое письма"
     *                 ),
     *                 @OA\Property(
     *                     property="deliver_at_minutes",
     *                     type="integer",
     *                     example=1440,
     *                     description="Внутриигровое время доставки письма в минутах"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mail updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Mail")
     *     ),
     *     @OA\Response(response=404, description="Mail not found")
     * )
     */
    public function update(UpdateMailRequest $request, Mail $mail): JsonResponse {
        $mail->update($request->validated());

        return response()->json($mail);
    }

    /**
     * @OA\Delete(
     *     path="/api/mails/{mail}",
     *     summary="Удалить письмо",
     *     tags={"Mails"},
     *     @OA\Parameter(
     *         name="mail",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID письма"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Mail deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Mail not found")
     * )
     */
    public function destroy(Mail $mail): JsonResponse {
        $mail->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/mails",
     *     summary="Получить все письма игрока",
     *     tags={"Mails"},
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
     *         description="Список писем игрока",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Mail"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="recipient_token не передан"
     *     )
     * )
     */
    public function index(GetMailsRequest $request, GetMailsAction $action): JsonResponse {
        $mails = $action(
            $request->input('recipient_token'),
            $request->input('current_minutes')
        );

        return response()->json($mails);
    }

    /**
     * @OA\Post(
     *     path="/api/mails/consume",
     *     summary="Получить новые письма и пометить их прочитанными",
     *     tags={"Mails"},
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
     *                     description="Токен игрока, получателя письма"
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
     *         description="Список доставленных писем, помеченных как прочитанные",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Mail"))
     *     )
     * )
     */
    public function consume(ConsumeMailsRequest $request, ConsumeMailsAction $consumeMailsAction): JsonResponse {
        $mails = $consumeMailsAction(
            $request->input('recipient_token'),
            $request->input('current_minutes')
        );

        return response()->json($mails);
    }
}
