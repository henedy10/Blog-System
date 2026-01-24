<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }
}
