<?php

namespace App\Http\Requests;

use App\Models\Mail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMailRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'recipient_token' => 'sometimes|string|max:128',
            'sender' => ['sometimes', Rule::in(Mail::SENDERS)],
            'subject' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
            'deliver_at_minutes' => 'sometimes|integer|min:0',
        ];
    }
}
