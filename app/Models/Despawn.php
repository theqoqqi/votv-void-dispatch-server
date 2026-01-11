<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Despawn
 *
 * @property int $id
 * @property string $recipient_token
 * @property string $name
 * @property float $location_x
 * @property float $location_y
 * @property float $location_z
 * @property float $tolerance_radius
 * @property int $deliver_at_minutes
 * @property bool $is_consumed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @OA\Schema(
 *     schema="Despawn",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="recipient_token", type="string"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="location_x", type="number", format="float"),
 *     @OA\Property(property="location_y", type="number", format="float"),
 *     @OA\Property(property="location_z", type="number", format="float"),
 *     @OA\Property(property="tolerance_radius", type="number", format="float"),
 *     @OA\Property(property="deliver_at_minutes", type="integer"),
 *     @OA\Property(property="is_consumed", type="boolean"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Despawn extends Model {

    protected $fillable = [
        'recipient_token',
        'name',
        'location_x',
        'location_y',
        'location_z',
        'tolerance_radius',
        'deliver_at_minutes',
        'is_consumed',
    ];

    protected $casts = [
        'is_consumed' => 'boolean',
        'deliver_at_minutes' => 'integer',
        'location_x' => 'float',
        'location_y' => 'float',
        'location_z' => 'float',
        'tolerance_radius' => 'float',
    ];
}
