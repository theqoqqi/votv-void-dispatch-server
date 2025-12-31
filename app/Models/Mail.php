<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Mail
 *
 * @property int $id
 * @property string $recipient_token
 * @property string $sender
 * @property string $subject
 * @property string $body
 * @property int $deliver_at_minutes
 * @property bool $is_read
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Mail extends Model {

    public const SENDERS = [
        'Dr_Bao',
        'Prof_Lea',
        'Auto',
        'Dr_Max',
        'Dr_Ken',
        'Dr_Ena',
        'Dr_Ula',
        'Dr_Ler',
        'user',
        'Dr_Noa',
    ];

    protected $fillable = [
        'recipient_token',
        'sender',
        'subject',
        'body',
        'deliver_at_minutes',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'deliver_at_minutes' => 'integer',
    ];
}
