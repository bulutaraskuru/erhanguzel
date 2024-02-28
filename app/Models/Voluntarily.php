<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voluntarily
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property string $neighbourhood
 * @property string $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily whereNeighbourhood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntarily whereYear($value)
 * @mixin \Eloquent
 */
class Voluntarily extends Model
{
    use HasFactory;

    protected $table = 'voluntarilies';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'neighbourhood',
        'year',
    ];
}
