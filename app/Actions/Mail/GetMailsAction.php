<?php

namespace App\Actions\Mail;

use App\Actions\BaseGetAction;
use App\Models\Mail;
use Illuminate\Database\Eloquent\Builder;

class GetMailsAction extends BaseGetAction {

    protected function createQuery(): Builder {
        return Mail::query();
    }
}
