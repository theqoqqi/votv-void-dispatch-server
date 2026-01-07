<?php

namespace App\Actions\Effect;

use App\Actions\BaseGetAction;
use App\Models\Effect;
use Illuminate\Database\Eloquent\Builder;

class GetEffectsAction extends BaseGetAction {

    protected function createQuery(): Builder {
        return Effect::query();
    }
}
