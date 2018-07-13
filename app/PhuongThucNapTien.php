<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhuongThucNapTien extends Model
{
    protected $table = 'phuongthucnaptien';
    public $timestamps = false;
    protected $primaryKey = 'maphuongthuc';
    public $incrementing = false;
}
