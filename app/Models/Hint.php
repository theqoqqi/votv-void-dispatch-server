<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Hint
 *
 * @property int $id
 * @property string $recipient_token
 * @property string $type
 * @property string $text
 * @property int $deliver_at_minutes
 * @property bool $is_consumed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @OA\Schema(
 *     schema="Hint",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="recipient_token", type="string"),
 *     @OA\Property(property="type", type="string"),
 *     @OA\Property(property="text", type="string"),
 *     @OA\Property(property="deliver_at_minutes", type="integer"),
 *     @OA\Property(property="is_consumed", type="boolean"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Hint extends Model {

    public const TYPES = [
        'info',
        'warning',
        'error',
        'thought',
    ];

    protected $fillable = [
        'recipient_token',
        'type',
        'text',
        'deliver_at_minutes',
        'is_consumed',
    ];

    protected $casts = [
        'is_consumed' => 'boolean',
        'deliver_at_minutes' => 'integer',
    ];
}
