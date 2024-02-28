<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string $img
 * @property string $title_small
 * @property string $title_big
 * @property string $description
 * @property string $link_type
 * @property string $link
 * @property int $order_number
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereLinkType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitleBig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitleSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $fillable = [
        'img',
        'title_small',
        'title_big',
        'description',
        'link_type',
        'link',
        'is_active',
        'order_number',
    ];
}
