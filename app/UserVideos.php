<?php

namespace App;

use App\CommonField;
use App\TemplateVideos;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserVideos extends Model
{
    const FILLABLE = [
        'project_id',
        'project_title',
        'direct_download',
        'video_url',
        'user_id',
        'common_field_id',
        'template_video_id',
        'options',
        'status'
    ];

    protected $fillable = self::FILLABLE;
    protected $table = 'user_videos';

    public function commonFields()
    {
        return $this->belongsTo(CommonField::class, 'common_field_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function templateFields()
    {
        return $this->belongsToMany(
                        TemplateField::class,
                        'user_videos_fields',
                        'user_videos_id',
                        'template_fields_id')
                    ->withPivot('value')
                    ->using(UserVideosFields::class);
    }

    public function video()
    {
        return $this->belongsTo(TemplateVideos::class, 'template_video_id');
    }

}
