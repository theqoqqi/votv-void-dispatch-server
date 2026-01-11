<?php

namespace App\Actions\Despawn;

use App\Actions\BaseConsumeAction;
use App\Models\Despawn;
use Illuminate\Database\Eloquent\Builder;

class ConsumeDespawnsAction extends BaseConsumeAction {

    protected function createQuery(): Builder {
        return Despawn::query();
    }
}
