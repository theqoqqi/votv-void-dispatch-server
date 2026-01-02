<?php

namespace App\Http\Requests;

use App\Models\Effect;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEffectRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'recipient_token' => ['required', 'string'],
            'property' => ['required', 'string', Rule::in(Effect::PROPERTIES)],
            'value' => ['required', 'string'],
            'deliver_at_minutes' => ['required', 'integer', 'min:0'],
        ];
    }
}
