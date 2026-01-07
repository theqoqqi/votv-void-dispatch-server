<?php

namespace App\Actions\Mail;

use App\Actions\BaseConsumeAction;
use App\Models\Mail;
use Illuminate\Database\Eloquent\Builder;

class ConsumeMailsAction extends BaseConsumeAction {

    protected function createQuery(): Builder {
        return Mail::query();
    }
}
