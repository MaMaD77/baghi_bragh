<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;
    // use LogsActivity;

    // protected static $recordEvents = ['updated', 'deleted'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logOnly([
    //             '*',
    //         ])
    //         ->logExcept(['updated_at'])
    //         ->dontLogIfAttributesChangedOnly(['updated_at'])
    //         ->logOnlyDirty()
    //         ->dontSubmitEmptyLogs();
    // }

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

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
        'id' => 'string',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $uuid = str()->uuid()->toString();
            $model->id = $uuid;
            $model->disk = config('filesystems.default');
        });
    }

    /**
     * Get the parent fileable model (user or post).
     */
    public function fileable()
    {
        return $this->morphTo();
    }

    /**
     * Get the parent fileable model (user or post).
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the URL to the files's path.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    /**
     * Get the URL to the files's path.
     *
     * @return string
     */
    public function getIconAttribute()
    {
        if (substr($this->mime_type, 0, 5) == 'image') {
            $icon_class = 'far fa-file-image';
        } else if ($this->extension == 'pdf') {
            $icon_class = 'far fa-file-pdf';
        } else if ($this->extension == 'doc') {
            $icon_class = 'far fa-file-word';
        } else if ($this->extension == 'txt') {
            $icon_class = 'far fa-file-alt';
        } else {
            $icon_class = 'far fa-file';
        }

        return $icon_class;
    }

    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'icon',
        'url',
    ];
}
