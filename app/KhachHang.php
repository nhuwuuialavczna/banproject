<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{

    protected $table = 'khachhang';
    public $timestamps = false;
    protected $primaryKey = 'taikhoan';
    public $incrementing = false;
}
