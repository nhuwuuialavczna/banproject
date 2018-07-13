<?php

namespace App\Http\Controllers;

use App\LichSuNapTien;
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
//        $lichsu = new LichSuNapTien();
        $khachhang = Session::get('khachhang');
        $lichsunaptien = LichSuNapTien::where('taikhoan', $khachhang->taikhoan)->get();
        return view('naptien', ['lichSu' => $lichsunaptien]);
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
