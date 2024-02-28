<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectGallery
 *
 * @property int $id
 * @property int $project_id
 * @property string $img
 * @property string $order_number
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectGallery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProjectGallery extends Model
{
    use HasFactory;

    protected $table = 'project_galleries';

    protected $fillable = ['project_id', 'img', 'order_number', 'is_active'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
