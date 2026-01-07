<?php

namespace App\Http\Requests\Spawn;

class UpdateSpawnRequest extends SpawnPayloadRequest {

    protected string $action = self::ACTION_UPDATE;
}
