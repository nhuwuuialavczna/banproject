<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaiXuong extends Model
{
    protected $table = 'taixuong';
    public $timestamps = false;
    protected $primaryKey = 'mataixuong';
    public $incrementing = false;
}
