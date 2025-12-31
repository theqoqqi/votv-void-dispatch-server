<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMailRequest;
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
}
