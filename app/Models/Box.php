<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Box
 *
 * @property int $id
 * @property string $img
 * @property string $title
 * @property string $description
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Box newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Box newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Box query()
 * @method static \Illuminate\Database\Eloquent\Builder|Box whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Box whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Box whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Box whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Box whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Box whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Box whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Box extends Model
{
    use HasFactory;

    protected $table = 'boxes';

    protected $fillable = [
        'img',
        'title',
        'description',
        'is_active',
    ];
}
