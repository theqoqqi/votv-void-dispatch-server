<?php

use App\Http\Controllers\Api\HintController;
use App\Http\Controllers\Api\MailController;
use App\Http\Controllers\Api\EffectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/mails', MailController::class);
Route::post('/mails/consume', [MailController::class, 'consume']);

Route::apiResource('/effects', EffectController::class);
Route::post('/effects/consume', [EffectController::class, 'consume']);

Route::apiResource('/hints', HintController::class);
Route::post('/hints/consume', [HintController::class, 'consume']);
