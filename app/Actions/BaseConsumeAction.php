<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseConsumeAction {

    public function __invoke(string $recipientToken, int $currentMinutes): Collection {
        $consumables = $this->createQuery()
            ->where('recipient_token', $recipientToken)
            ->where('deliver_at_minutes', '<=', $currentMinutes)
            ->where('is_consumed', false)
            ->get();

        if ($consumables->isNotEmpty()) {
            $this->createQuery()
                ->whereIn('id', $consumables->pluck('id'))
                ->update(['is_consumed' => true]);
        }

        return $consumables;
    }

    protected abstract function createQuery(): Builder;
}
