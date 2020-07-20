<?php

namespace Evention\Elequent\Traits;

trait HasChildren
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * @return bool
     */
    public function isParent()
    {
        return is_null($this->parent_id);
    }

    /**
     * @return bool
     */
    public function isChild()
    {
        return ! is_null($this->parent_id);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotChild($query)
    {
        return $query->whereNull('parent_id');
    }
    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsChildren($query)
    {
        return $query->whereNotNull('parent_id');
    }
}