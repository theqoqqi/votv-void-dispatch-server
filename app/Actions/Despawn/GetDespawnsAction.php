<?php

namespace App\Actions\Despawn;

use App\Actions\BaseGetAction;
use App\Models\Despawn;
use Illuminate\Database\Eloquent\Builder;

class GetDespawnsAction extends BaseGetAction {

    protected function createQuery(): Builder {
        return Despawn::query();
    }
}
