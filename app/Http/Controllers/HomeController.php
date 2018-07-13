<?php

namespace App\Http\Controllers;

use App\LichSuNapTien;
use App\LinhVuc;
use App\TaiLieu;
use App\TaiXuong;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function Index()
    {
        $linhVuc = new LinhVuc();
        $listLinhVuc = $linhVuc->get();

        if (Session::get('listTaiLieu') == null) {
            Session::put('dangxem', 'Đang xem trên tất cả project');
            $taiLieu = new TaiLieu();
            $listProject = $taiLieu->get();
            Session::put('listTaiLieu', $listProject); // tất cả project
            Session::put('loaitailieu', 'tatca'); // tất cả project
        }

        return view('trangchu', ['getAll' => $listLinhVuc,'title'=>'Bán đồ án, dự án, luận văn tốt nghiệp bài tập lớn công nghệ thông tin']);
    }

    public function XemTatCa()
    {
        $linhVuc = new LinhVuc();
        Session::put('dangxem', 'Đang xem trên tất cả project');
        $listLinhVuc = $linhVuc->get();
        $taiLieu = new TaiLieu();
        $listProject = $taiLieu->get();
        Session::put('listTaiLieu', $listProject); // tất cả project
        Session::put('loaitailieu', 'tatca'); // tất cả project
        return view('trangchu', ['getAll' => $listLinhVuc,'title'=>'Bán đồ án, dự án, luận văn tốt nghiệp bài tập lớn công nghệ thông tin']);
    }


    public function NapTien()
    {
//        $lichsu = new LichSuNapTien();
        $khachhang = Session::get('khachhang');
        $lichsunaptien = LichSuNapTien::where('taikhoan', $khachhang->taikhoan)->orderBy('thoigiannaptien', 'DESC')->take(5)->get();

        $lichsutaixuong = TaiXuong::where('taikhoan', $khachhang->taikhoan)->orderBy('thoigian', 'DESC')->take(5)->get();
        return view('naptien', ['lichSu' => $lichsunaptien, 'lichSuTaiXuong' => $lichsutaixuong,'title'=>'Nạp tiền vào tài khoản']);
    }

    function DangNhap()
    {
        return view('dangnhap', ['tb' => '','title'=>'Đăng nhập']);
    }

//    function ChiTiet()
//    {
//        return view('chitietproject',['title'=>'Đăng nhập']);
//    }

    public function ThongBao()
    {
        return view('thongbao',['title'=>'Thông báo']);
    }
}
