<?php

namespace App\Http\Controllers;

use App\KhachHang;
use App\LinhVuc;
use App\TaiLieu;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function LocProject(Request $request)
    {
        $loaiTaiLieu = $request->loaitailieu;
        $tenloai = $request->tenloai;
        $linhVuc = new LinhVuc();
        Session::put('dangxem', 'Đang xem trên tất cả project thuộc ' . $tenloai);
        $listLinhVuc = $linhVuc->get();

        $listProject = TaiLieu::where('maloai', $loaiTaiLieu)->get();
        Session::put('listTaiLieu', $listProject); // tất cả project

        return view('trangchu', ['getAll' => $listLinhVuc]);
    }

    public function ChiTiet(Request $request)
    {
        $matailieu = $request->matailieu;
        $tailieu = TaiLieu::where('matailieu', $matailieu)->first(); // lấy ra 1 tài liệu
        TaiLieu::where('matailieu', $matailieu)->update(['soluotxem' => $tailieu->soluotxem + 1]);
        $listCungLoai = TaiLieu::where('maloai', $tailieu->maloai)->get();
        return view('chitietproject', ['getOne' => $tailieu, 'listCungLoai' => $listCungLoai]);
    }

    public function ThanhToan(Request $request)
    {
        $matailieu = $request->matailieu;
        $gia = $request->gia;
        $soluotai = $request->soluottai;
        $khachhang = Session::get('khachhang');

        $soTienConLai = $khachhang->sodu - $gia;

        TaiLieu::where('matailieu', $matailieu)->update(['soluottai' => $soluotai + 1]);

        $tailieu = TaiLieu::where('matailieu', $matailieu)->first();

        $khachhang->sodu = $soTienConLai;
        KhachHang::where('taikhoan', $khachhang->taikhoan)->update(['sodu' => $soTienConLai]);
        Session::put('khachhang', $khachhang);
        Session::put('thongbao', 'taixuong');
        Session::put('thongbaotaixuong', $tailieu);
        return redirect('/thongbao');
    }

}
