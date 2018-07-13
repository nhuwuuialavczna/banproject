<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaiLieu extends Model
{
    protected $table = 'tailieu';
    public $timestamps = false;
    protected $primaryKey = 'matailieu';
    public $incrementing = false;

    public function loaiTaiLieu()
    {
        return $this->belongsTo('App\LoaiTaiLieu', 'maloai');
    }

    public function getLoaiTaiLieu()
    {
        return $this->loaiTaiLieu->toArray();
    }


    public function listTaiXuong()
    {
        return $this->hasMany('App\TaiXuong', 'matailieu');
    }

    public function getListTaiXuong()
    {
        return $this->listTaiXuong;
    }
}
