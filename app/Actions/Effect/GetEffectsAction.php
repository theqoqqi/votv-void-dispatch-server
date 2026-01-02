<?php

namespace App\Actions\Effect;

use App\Models\Effect;
use Illuminate\Support\Collection;

class GetEffectsAction {

    public function __invoke(string $recipientToken, ?int $currentMinutes = null): Collection {
        $query = Effect::query()
            ->where('recipient_token', $recipientToken);

        if ($currentMinutes !== null) {
            $query->where('deliver_at_minutes', '<=', $currentMinutes);
        }

        return $query->get();
    }
}
