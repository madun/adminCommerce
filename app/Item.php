<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    protected $fillable = [
        'displayname', 'description', 'count_review', 'count_view', 'count', 'weight', 'price', 'image_item', 'promotion_item', 'additionalinfo',
    ];

}
