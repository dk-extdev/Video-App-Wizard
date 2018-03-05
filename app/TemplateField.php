<?php

namespace App;

use App\TemplateGroup;
use Illuminate\Database\Eloquent\Model;

class TemplateField extends Model
{
    protected $table = 'template_field';

    public function templateGroup()
    {
        return $this->belongsTo(TemplateGroup::class);
    }
}
