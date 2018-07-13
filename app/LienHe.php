<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    protected $table = 'lienhe';
    public $timestamps = false;
    protected $primaryKey = 'malienhe';
    public $incrementing = false;
}
