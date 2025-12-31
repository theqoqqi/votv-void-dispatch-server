<?php

namespace App\Actions\Mail;

use App\Models\Mail;
use Illuminate\Support\Collection;

class GetMailsAction {

    public function __invoke(string $recipientToken, ?int $currentMinutes = null): Collection {
        $query = Mail::query()
            ->where('recipient_token', $recipientToken);

        if ($currentMinutes !== null) {
            $query->where('deliver_at_minutes', '<=', $currentMinutes);
        }

        return $query->get();
    }
}
