<?php

namespace App\Http\Requests\Spawn;

class StoreSpawnRequest extends SpawnPayloadRequest {

    protected string $action = self::ACTION_STORE;
}
