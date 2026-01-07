<?php

namespace App\Actions\Mail;

use App\Models\Mail;
use Illuminate\Support\Collection;

class ConsumeMailsAction {

    public function __invoke(string $recipientToken, int $currentMinutes): Collection {
        $mails = Mail::query()
            ->where('recipient_token', $recipientToken)
            ->where('deliver_at_minutes', '<=', $currentMinutes)
            ->where('is_consumed', false)
            ->get();

        if ($mails->isNotEmpty()) {
            Mail::query()
                ->whereIn('id', $mails->pluck('id'))
                ->update(['is_consumed' => true]);
        }

        return $mails;
    }
}
