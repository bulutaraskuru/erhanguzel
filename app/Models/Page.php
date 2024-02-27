<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $img
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $is_active
 * @property int $location
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Page extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'pages';

    protected $fillable = ['img', 'title', 'slug', 'description', 'is_active', 'location', 'seo_title', 'seo_description', 'seo_keywords'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
