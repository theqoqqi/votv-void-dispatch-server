<?php

namespace App\Http\Requests\Mail;

class UpdateMailRequest extends MailPayloadRequest {

    protected string $action = self::ACTION_UPDATE;
}
