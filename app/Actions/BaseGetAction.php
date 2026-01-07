<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

abstract class BaseGetAction {

    public function __invoke(string $recipientToken, ?int $currentMinutes = null): Collection {
        $query = $this->createQuery()
            ->where('recipient_token', $recipientToken);

        if ($currentMinutes !== null) {
            $query->where('deliver_at_minutes', '<=', $currentMinutes);
        }

        return $query->get();
    }

    abstract protected function createQuery(): Builder;
}
