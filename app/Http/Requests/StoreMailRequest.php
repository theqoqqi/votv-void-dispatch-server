<?php

namespace App\Http\Requests;

use App\Models\Mail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMailRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'recipient_token' => 'required|string|max:128',
            'sender' => ['required', Rule::in(Mail::SENDERS)],
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'deliver_at_minutes' => 'required|integer|min:0',
        ];
    }
}
