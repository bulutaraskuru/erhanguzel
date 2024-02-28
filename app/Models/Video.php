<?php

namespace App\Models;


use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Video extends Model implements Viewable
{
    use HasFactory, HasSlug, InteractsWithViews;

    protected $table = 'videos';

    protected $fillable = [
        'img',
        'video_url',
        'title',
        'slug',
        'description',
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
        $data = Video::findOrFail($id);

        return $data->$variable;
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
