<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommonField extends Model
{
    const FILLABLE = [
        'sender_name',
        'sender_email',
        'email_subject',
        'customer_first_name',
        'customer_last_name',
        'customer_email'
    ];

    const VALIDATION_RULES = [
        'sender_name' => 'required|max:50',
        'sender_email' => 'required|email',
        'email_subject' => 'sometimes|max:255',
        'customer_first_name' => 'required|max:50',
        'customer_last_name' => 'required|max:50',
        'customer_email' => 'required|email'
    ];

    public $timestamps = false;
    protected $fillable = self::FILLABLE;
    protected $table = 'common_field';
}
