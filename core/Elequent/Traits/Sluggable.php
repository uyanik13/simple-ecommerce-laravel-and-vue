<?php

namespace Evention\Elequent\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * @return mixed|string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSluggable()
    {
        static::created(function ($model) {
            $model->update(['slug' => $model->title]);
        });
    }

    /**
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['slug'] = $slug;
    }
}