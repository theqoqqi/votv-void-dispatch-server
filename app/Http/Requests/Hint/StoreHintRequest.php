<?php

namespace App\Http\Requests\Hint;

class StoreHintRequest extends HintPayloadRequest {

    protected string $action = self::ACTION_STORE;
}
