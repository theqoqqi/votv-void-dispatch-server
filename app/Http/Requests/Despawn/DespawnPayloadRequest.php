<?php

namespace App\Http\Requests\Despawn;

use App\Http\Requests\BasePayloadRequest;

abstract class DespawnPayloadRequest extends BasePayloadRequest {

    protected function resourceRules(): array {
        return [
            'name' => ['string'],
            'location_x' => ['numeric'],
            'location_y' => ['numeric'],
            'location_z' => ['numeric'],
            'tolerance_radius' => ['numeric'],
        ];
    }
}
