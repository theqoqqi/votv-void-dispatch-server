<?php

namespace App\Http\Requests\Effect;

class UpdateEffectRequest extends EffectPayloadRequest {

    protected string $action = self::ACTION_UPDATE;
}
