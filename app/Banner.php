<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'slidingbanner';
    protected $fillable = [
        'title', 'image', 'status', 'parent_id',  'for', 'background',  'listnumber',
    ];
}
