<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommonField extends Model
{
    const FILLABLE = [
        'sender_name',
        'sender_email',
        'email_subject',
        'email_body',
        'customer_first_name',
        'customer_last_name',
        'customer_email',
        'customer_domain'
    ];

    const VALIDATION_RULES = [
        'sender_name' => 'required|max:50',
        'sender_email' => 'required|email',
        'email_subject' => 'sometimes|max:255',
        'email_body' => 'sometimes|max:1000',
        'customer_first_name' => 'required|max:50',
        'customer_last_name' => 'required|max:50',
        'customer_email' => 'required|email',
        'customer_domain' => 'sometimes|max:80'
    ];

    public $timestamps = false;
    protected $fillable = self::FILLABLE;
    protected $table = 'common_field';
}
