<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTaiLieu extends Model
{
    protected $table = 'loaitailieu';
    public $timestamps = false;
    protected $primaryKey = 'maloai';
    public $incrementing = false;

    public function linhVuc()
    {
        return $this->belongsTo('App\LinhVuc', 'malinhvuc');
    }

    public function getLinhVuc()
    {
        return $this->linhVuc->toArray();
    }


    public function listTaiLieu()
    {
        return $this->hasMany('App\TaiLieu', 'maloai');
    }

    public function getListTaiLieu()
    {
        return $this->listTaiLieu;
    }

}
