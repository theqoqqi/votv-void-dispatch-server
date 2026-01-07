<?php

namespace App\Actions\Hint;

use App\Actions\BaseConsumeAction;
use App\Models\Hint;
use Illuminate\Database\Eloquent\Builder;

class ConsumeHintsAction extends BaseConsumeAction {

    protected function createQuery(): Builder {
        return Hint::query();
    }
}
