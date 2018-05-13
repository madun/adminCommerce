<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $table = 'email';
    protected $primaryKey = "id";
    protected $fillable = [
        'template_name', 'template', 
    ];
}
