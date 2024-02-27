<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sss
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $is_active
 * @property int $order_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\SssFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Sss newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sss newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sss query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sss whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sss whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sss whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sss whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sss whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sss whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sss whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Sss extends Model
{
    use HasFactory;

    protected $table = 'ssses';

    protected $fillable = ['question',  'answer', 'is_active', 'order_number'];
}
