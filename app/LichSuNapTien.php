<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LichSuNapTien extends Model
{
    protected $table = 'lichsunaptien';
    public $timestamps = false;
    protected $primaryKey = 'manaptien';
    public $incrementing = false;
}
