<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $primaryKey = "id";
    protected $fillable = [
        'kode', 'start_date', 'end_date', 'discount', 'status', 'level', 
    ];
}
