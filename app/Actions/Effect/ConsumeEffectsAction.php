<?php

namespace App\Actions\Effect;

use App\Actions\BaseConsumeAction;
use App\Models\Effect;
use Illuminate\Database\Eloquent\Builder;

class ConsumeEffectsAction extends BaseConsumeAction {

    protected function createQuery(): Builder {
        return Effect::query();
    }
}
