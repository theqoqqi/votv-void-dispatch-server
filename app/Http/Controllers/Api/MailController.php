<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMailRequest;
use App\Models\Mail;
use Illuminate\Http\JsonResponse;

class MailController extends Controller {

    public function store(StoreMailRequest $request): JsonResponse {
        /** @var $mail Mail */
        $mail = Mail::query()->create($request->validated());

        return response()->json($mail, 201);
    }
}
