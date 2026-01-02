<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Effect
 *
 * @property int $id
 * @property string $recipient_token
 * @property string $property
 * @property string|null $value
 * @property int $deliver_at_minutes
 * @property bool $is_applied
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @OA\Schema(
 *     schema="Effect",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="recipient_token", type="string"),
 *     @OA\Property(property="property", type="string"),
 *     @OA\Property(property="value", type="string", nullable=true),
 *     @OA\Property(property="deliver_at_minutes", type="integer"),
 *     @OA\Property(property="is_applied", type="boolean"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Effect extends Model {

    protected $table = 'effects';

    protected $fillable = [
        'recipient_token',
        'property',
        'value',
        'deliver_at_minutes',
        'is_applied',
    ];

    public const PROPERTIES = [
        'points',
        'food',
        'sleep',
        'health',
    ];
}
