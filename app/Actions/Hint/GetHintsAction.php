<?php

namespace App\Actions\Hint;

use App\Actions\BaseGetAction;
use App\Models\Hint;
use Illuminate\Database\Eloquent\Builder;

class GetHintsAction extends BaseGetAction {

    protected function createQuery(): Builder {
        return Hint::query();
    }
}
