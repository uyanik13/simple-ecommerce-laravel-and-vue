<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Evention\Elequent\Traits\HasChildren;
use Illuminate\Database\Eloquent\SoftDeletes;
use Evention\Elequent\Traits\Relations\HasUser;
use Evention\Elequent\Traits\Relations\HasProduct;

class Review extends Model
{
    use SoftDeletes, HasChildren, HasUser, HasProduct;

    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    /** The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
    ];

    /**
     * Date casts.
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    /**
     * Appends to JSON.
     *
     * @var array
     */
    protected $appends = [
        //
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'children'
    ];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }
}
