<?php

namespace App\Models\Traits;

use App\Models\Scopes\SoftDeletingWithTrashedScope;
use Illuminate\Database\Eloquent\SoftDeletes;

trait SoftDeletesWithTrashed
{
    use SoftDeletes;

    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new SoftDeletingWithTrashedScope());
    }
}
