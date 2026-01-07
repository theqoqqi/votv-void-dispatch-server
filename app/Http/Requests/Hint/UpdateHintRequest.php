<?php

namespace App\Http\Requests\Hint;

class UpdateHintRequest extends HintPayloadRequest {

    protected string $action = self::ACTION_UPDATE;
}
