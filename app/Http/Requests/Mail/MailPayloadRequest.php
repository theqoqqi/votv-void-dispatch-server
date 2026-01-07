<?php

namespace App\Http\Requests\Mail;

use App\Http\Requests\BasePayloadRequest;
use App\Models\Mail;
use Illuminate\Validation\Rule;

abstract class MailPayloadRequest extends BasePayloadRequest {

    protected function resourceRules(): array {
        return [
            'sender' => [Rule::in(Mail::SENDERS)],
            'subject' => ['string', 'max:255'],
            'body' => ['string'],
        ];
    }
}
