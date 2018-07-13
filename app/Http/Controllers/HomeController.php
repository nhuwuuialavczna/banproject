<?php

namespace App\Http\Controllers;

use App\LinhVuc;
use App\TaiLieu;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function Index()
    {
        $linhVuc = new LinhVuc();
        Session::put('dangxem', 'Đang xem trên tất cả project');
        $listLinhVuc = $linhVuc->get();

        $taiLieu = new TaiLieu();
        $listProject = $taiLieu->get();
        Session::put('listTaiLieu', $listProject); // tất cả project

        return view('trangchu', ['getAll' => $listLinhVuc]);
    }



    public function NapTien()
    {
        return view('naptien');
    }

    function DangNhap()
    {
        return view('dangnhap', ['tb' => '']);
    }

    function ChiTiet()
    {
        return view('chitietproject');
    }

    public function ThongBao()
    {
        return view('thongbao');
    }
}
