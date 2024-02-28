<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $img
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $is_active
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $project_category_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectCategory> $category
 * @property-read int|null $category_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Project> $image
 * @property-read int|null $image_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \CyrildeWit\EloquentViewable\View> $views
 * @property-read int|null $views_count
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project orderByUniqueViews(string $direction = 'desc', $period = null, ?string $collection = null, string $as = 'unique_views_count')
 * @method static \Illuminate\Database\Eloquent\Builder|Project orderByViews(string $direction = 'desc', ?\CyrildeWit\EloquentViewable\Support\Period $period = null, ?string $collection = null, bool $unique = false, string $as = 'views_count')
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereProjectCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project withViewsCount(?\CyrildeWit\EloquentViewable\Support\Period $period = null, ?string $collection = null, bool $unique = false, string $as = 'views_count')
 * @mixin \Eloquent
 */
class Project extends Model implements Viewable
{
    use HasFactory, HasSlug, InteractsWithViews;

    protected $table = 'projects';

    protected $fillable = [
        'img',
        'title',
        'project_category_id',
        'slug',
        'description',
        'is_active',
        'view_count',
        'seo_title',
        'seo_description',
        'seo_keywords',
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

    public function image()
    {
        return $this->hasMany(Project::class);
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class,'project_category_id','id');
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
