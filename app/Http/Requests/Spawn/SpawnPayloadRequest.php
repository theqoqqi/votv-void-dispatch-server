<?php

namespace App\Http\Requests\Spawn;

use App\Http\Requests\BasePayloadRequest;

abstract class SpawnPayloadRequest extends BasePayloadRequest {

    protected function resourceRules(): array {
        return [
            'name' => ['string'],
            'location_x' => ['numeric', 'nullable'],
            'location_y' => ['numeric', 'nullable'],
            'location_z' => ['numeric', 'nullable'],
            'rotation_x' => ['numeric', 'nullable'],
            'rotation_y' => ['numeric', 'nullable'],
            'rotation_z' => ['numeric', 'nullable'],
            'scale_x' => ['numeric', 'nullable'],
            'scale_y' => ['numeric', 'nullable'],
            'scale_z' => ['numeric', 'nullable'],
        ];
    }
}
