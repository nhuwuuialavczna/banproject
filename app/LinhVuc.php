<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinhVuc extends Model
{
    protected $table = 'linhvuc';
    public $timestamps = false;
    protected $primaryKey = 'malinhvuc';
    public $incrementing = false;

    public function listLoai()
    {
        return $this->hasMany('App\LoaiTaiLieu', 'malinhvuc');
    }

    public function getListLoai()
    {
        return $this->listLoai;
    }

}
