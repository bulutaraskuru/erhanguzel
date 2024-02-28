<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\ProjectCategory
 *
 * @property int $id
 * @property string|null $img
 * @property string $title
 * @property string $slug
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $project
 * @property-read int|null $project_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \CyrildeWit\EloquentViewable\View> $views
 * @property-read int|null $views_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory orderByUniqueViews(string $direction = 'desc', $period = null, ?string $collection = null, string $as = 'unique_views_count')
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory orderByViews(string $direction = 'desc', ?\CyrildeWit\EloquentViewable\Support\Period $period = null, ?string $collection = null, bool $unique = false, string $as = 'views_count')
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectCategory withViewsCount(?\CyrildeWit\EloquentViewable\Support\Period $period = null, ?string $collection = null, bool $unique = false, string $as = 'views_count')
 * @mixin \Eloquent
 */
class ProjectCategory extends Model implements Viewable
{
    use HasFactory, HasSlug, InteractsWithViews;

    protected $table = 'project_categories';

    protected $fillable = [
        'img',
        'title',
        'slug',
        'is_active',
        'view_count',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public static function get_variable($id, $variable)
    {
        $data = Project::findOrFail($id);

        return $data->$variable;
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
