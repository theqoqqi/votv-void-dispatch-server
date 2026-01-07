<?php

namespace App\Http\Requests\Hint;

use App\Http\Requests\BasePayloadRequest;
use App\Models\Hint;
use Illuminate\Validation\Rule;

abstract class HintPayloadRequest extends BasePayloadRequest {

    protected function resourceRules(): array {
        return [
            'type' => [Rule::in(Hint::TYPES)],
            'text' => ['string'],
        ];
    }
}
