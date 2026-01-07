<?php

namespace App\Actions\Spawn;

use App\Actions\BaseConsumeAction;
use App\Models\Spawn;
use Illuminate\Database\Eloquent\Builder;

class ConsumeSpawnsAction extends BaseConsumeAction {

    protected function createQuery(): Builder {
        return Spawn::query();
    }
}
