<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVideosFields extends Pivot
{
    const FILLABLE = [
        'user_videos_id',
        'template_fields_id',
        'value'
    ];

    public $timestamps = false;
    protected $fillable = self::FILLABLE;
    protected $table = 'user_videos_fields';
}