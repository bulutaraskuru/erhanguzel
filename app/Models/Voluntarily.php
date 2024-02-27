<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
