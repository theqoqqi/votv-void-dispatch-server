<?php

namespace App\Actions\Effect;

use App\Models\Effect;
use Illuminate\Support\Collection;

class ConsumeEffectsAction {

    public function __invoke(string $recipientToken, int $currentMinutes): Collection {
        $effects = Effect::query()
            ->where('recipient_token', $recipientToken)
            ->where('deliver_at_minutes', '<=', $currentMinutes)
            ->where('is_consumed', false)
            ->get();

        if ($effects->isNotEmpty()) {
            Effect::query()
                ->whereIn('id', $effects->pluck('id'))
                ->update(['is_consumed' => true]);
        }

        return $effects;
    }
}
