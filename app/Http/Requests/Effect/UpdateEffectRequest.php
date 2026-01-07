<?php

namespace App\Http\Requests\Effect;

use App\Models\Effect;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEffectRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'recipient_token' => ['sometimes', 'string'],
            'property' => ['sometimes', 'string', Rule::in(Effect::PROPERTIES)],
            'value' => ['sometimes', 'string'],
            'deliver_at_minutes' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
