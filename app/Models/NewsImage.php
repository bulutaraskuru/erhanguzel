<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NewsImage
 *
 * @property int $id
 * @property int $new_id
 * @property string $img
 * @property string $order_number
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\News $news
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage whereNewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsImage whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class NewsImage extends Model
{
    use HasFactory;

    protected $table = 'news_images';

    protected $fillable = [
        'new_id',
        'img',
        'order_number',
        'is_active',
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'new_id', 'id');
    }
}
