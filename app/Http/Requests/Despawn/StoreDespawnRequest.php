<?php

namespace App\Http\Requests\Despawn;

class StoreDespawnRequest extends DespawnPayloadRequest {

    protected string $action = self::ACTION_STORE;
}
