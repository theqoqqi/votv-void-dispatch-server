<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BasePayloadRequest extends FormRequest {

    public const ACTION_STORE  = 'store';
    public const ACTION_UPDATE = 'update';

    protected string $action = self::ACTION_STORE;

    abstract protected function resourceRules(): array;

    protected function commonRules(): array {
        return [
            'recipient_token' => ['string', 'max:128'],
            'deliver_at_minutes' => ['integer', 'min:0'],
        ];
    }

    public function rules(): array {
        $prefix = $this->action === self::ACTION_UPDATE ? 'sometimes' : 'required';

        $rules = array_merge(
            $this->commonRules(),
            $this->resourceRules()
        );

        return array_map(
            fn($rules) => array_merge([$prefix], $rules),
            $rules
        );
    }
}
