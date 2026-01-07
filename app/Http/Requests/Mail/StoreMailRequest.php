<?php

namespace App\Http\Requests\Mail;

class StoreMailRequest extends MailPayloadRequest {

    protected string $action = self::ACTION_STORE;
}
