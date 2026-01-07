<?php

namespace App\Http\Requests\Effect;

use App\Http\Requests\BasePayloadRequest;
use App\Models\Effect;
use Illuminate\Validation\Rule;

abstract class EffectPayloadRequest extends BasePayloadRequest {

    protected function resourceRules(): array {
        return [
            'property' => ['string', Rule::in(Effect::PROPERTIES)],
            'value' => ['string'],
        ];
    }
}
