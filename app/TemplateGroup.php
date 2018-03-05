<?php

namespace App;

use App\TemplateField;
use Illuminate\Database\Eloquent\Model;

class TemplateGroup extends Model
{
    protected $table = 'template_group';

    public function fields()
    {
        return $this->hasMany(TemplateField::class);
    }
}
