<?php

namespace App\Http\Requests\Despawn;

class UpdateDespawnRequest extends DespawnPayloadRequest {

    protected string $action = self::ACTION_UPDATE;
}
