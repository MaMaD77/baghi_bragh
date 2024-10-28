<?php

namespace App\Models;

use App\Enums\Profile;
use App\Enums\ProfileType;
use App\Models\Traits\SoftDeletesWithTrashed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use SoftDeletesWithTrashed;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'profile' => Profile::class,
        'profile_type' => ProfileType::class,
    ];
}
