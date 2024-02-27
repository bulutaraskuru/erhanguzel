<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Partner
 *
 * @property int $id
 * @property string $img
 * @property string $title
 * @property string $description
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Partner extends Model
{
    use HasFactory;

    protected $table = 'partners';

    protected $fillable = [
        'title',
        'description',
        'img',
        'is_active',
    ];
}
