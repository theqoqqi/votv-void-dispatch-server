<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Spawn
 *
 * @property int $id
 * @property string $recipient_token
 * @property string $name
 * @property float|null $location_x
 * @property float|null $location_y
 * @property float|null $location_z
 * @property float|null $rotation_x
 * @property float|null $rotation_y
 * @property float|null $rotation_z
 * @property float|null $scale_x
 * @property float|null $scale_y
 * @property float|null $scale_z
 * @property int $deliver_at_minutes
 * @property bool $is_consumed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @OA\Schema(
 *     schema="Spawn",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="recipient_token", type="string"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="location_x", type="number", format="float", nullable=true),
 *     @OA\Property(property="location_y", type="number", format="float", nullable=true),
 *     @OA\Property(property="location_z", type="number", format="float", nullable=true),
 *     @OA\Property(property="rotation_x", type="number", format="float", nullable=true),
 *     @OA\Property(property="rotation_y", type="number", format="float", nullable=true),
 *     @OA\Property(property="rotation_z", type="number", format="float", nullable=true),
 *     @OA\Property(property="scale_x", type="number", format="float", nullable=true),
 *     @OA\Property(property="scale_y", type="number", format="float", nullable=true),
 *     @OA\Property(property="scale_z", type="number", format="float", nullable=true),
 *     @OA\Property(property="deliver_at_minutes", type="integer"),
 *     @OA\Property(property="is_consumed", type="boolean"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Spawn extends Model {

    protected $fillable = [
        'recipient_token',
        'name',
        'location_x',
        'location_y',
        'location_z',
        'rotation_x',
        'rotation_y',
        'rotation_z',
        'scale_x',
        'scale_y',
        'scale_z',
        'deliver_at_minutes',
        'is_consumed',
    ];

    protected $casts = [
        'is_consumed' => 'boolean',
        'deliver_at_minutes' => 'integer',
        'location_x' => 'float',
        'location_y' => 'float',
        'location_z' => 'float',
        'rotation_x' => 'float',
        'rotation_y' => 'float',
        'rotation_z' => 'float',
        'scale_x' => 'float',
        'scale_y' => 'float',
        'scale_z' => 'float',
    ];
}
