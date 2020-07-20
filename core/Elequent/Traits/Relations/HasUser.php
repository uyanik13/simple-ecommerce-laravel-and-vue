<?php

namespace Evention\Elequent\Traits\Relations;

use App\Models\User;

trait HasUser
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}