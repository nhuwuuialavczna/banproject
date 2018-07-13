<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaiXuong extends Model
{
    protected $table = 'taixuong';
    public $timestamps = false;
    protected $primaryKey = 'mataixuong';
    public $incrementing = false;

    public function taiLieu()
    {
        return $this->belongsTo('App\TaiLieu', 'matailieu');
    }

    public function getTaiLieu()
    {
        return $this->taiLieu->toArray();
    }

}
