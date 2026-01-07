<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenericGetRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'recipient_token' => ['required', 'string', 'max:128'],
            'current_minutes' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
