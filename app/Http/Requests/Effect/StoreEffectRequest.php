<?php

namespace App\Http\Requests\Effect;

class StoreEffectRequest extends EffectPayloadRequest {

    protected string $action = self::ACTION_STORE;
}
