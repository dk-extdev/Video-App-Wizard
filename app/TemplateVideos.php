<?php

namespace App;

use App\Category;
use App\TemplateGroup;
use Illuminate\Database\Eloquent\Model;

class TemplateVideos extends Model
{
    protected $table = 'template_videos';
    public $timestamps = true;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function group()
    {
        return $this->belongsTo(TemplateGroup::class, 'template_group_id');
    }

    public function getCustomerMainVideoAttribute()
    {
        $replaced = str_replace('YouTube_Preview', 'Alpha', $this->name);
        return $replaced . '.mov';
    }

}
