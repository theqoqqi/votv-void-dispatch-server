<?php

namespace App\Actions\Spawn;

use App\Actions\BaseGetAction;
use App\Models\Spawn;
use Illuminate\Database\Eloquent\Builder;

class GetSpawnsAction extends BaseGetAction {

    protected function createQuery(): Builder {
        return Spawn::query();
    }
}
