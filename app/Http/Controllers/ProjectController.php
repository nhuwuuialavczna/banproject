<?php

namespace App\Http\Controllers;

use App\KhachHang;
use App\LinhVuc;
use App\LoaiTaiLieu;
use App\TaiLieu;
use App\TaiXuong;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

// zxcvzxcvzx
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
        Session::put('loaitailieu', $loaiTaiLieu); // tất cả project
        Session::put('listTaiLieu', $listProject); // tất cả project
        return view('trangchu', ['getAll' => $listLinhVuc,'title'=>'Bán đồ án, dự án, luận văn tốt nghiệp bài tập lớn công nghệ thông tin']);
    }

    public function getNameLoai($loai)
    {
        $loai = LoaiTaiLieu::where('maloai', $loai)->first();
        return $loai != null ? $loai->tenloai : ' tất cả';
    }

    public function SapXep(Request $request)
    {
        $cachsapxep = $request->cachsapxep;
        $loaiTaiLieu = $request->loaitailieu;
        $listDangXem = Session::get('listTaiLieu');
        $dangxem = '';
        if ($cachsapxep == 'giacaonhat') {
            $dangxem = 'Đang xem trên ' . $this->getNameLoai($loaiTaiLieu) . '  giảm dần theo giá';

            if ($loaiTaiLieu != 'tatca') {
                $listDangXem = TaiLieu::where('maloai', $loaiTaiLieu)->orderBy('gia', 'DESC')->get();
            } else {
                $listDangXem = TaiLieu::orderBy('gia', 'DESC')->get();
            }

            Session::put('listTaiLieu', $listDangXem); // tất cả project
        }

        if ($cachsapxep == 'giathapnhat') {
            $dangxem = 'Đang xem trên ' . $this->getNameLoai($loaiTaiLieu) . '  tăng dần theo giá';

            if ($loaiTaiLieu != 'tatca') {
                $listDangXem = TaiLieu::where('maloai', $loaiTaiLieu)->orderBy('gia', 'ASC')->get();
            } else {
                $listDangXem = TaiLieu::orderBy('gia', 'ASC')->get();
            }

            Session::put('listTaiLieu', $listDangXem); // tất cả project
        }

        if ($cachsapxep == 'tainhieunhat') {
            $dangxem = 'Đang xem trên ' . $this->getNameLoai($loaiTaiLieu) . '  giảm dần theo lượt tải';

            if ($loaiTaiLieu != 'tatca') {
                $listDangXem = TaiLieu::where('maloai', $loaiTaiLieu)->orderBy('soluottai', 'DESC')->get();
            } else {
                $listDangXem = TaiLieu::orderBy('soluottai', 'DESC')->get();
            }

            Session::put('listTaiLieu', $listDangXem); // tất cả project
        }

        if ($cachsapxep == 'xemnhieunhat') {
            $dangxem = 'Đang xem trên ' . $this->getNameLoai($loaiTaiLieu) . ' giảm dần theo lượt xem';


            if ($loaiTaiLieu != 'tatca') {
                $listDangXem = TaiLieu::where('maloai', $loaiTaiLieu)->orderBy('soluotxem', 'DESC')->get();
            } else {
                $listDangXem = TaiLieu::orderBy('soluotxem', 'DESC')->get();
            }


            Session::put('listTaiLieu', $listDangXem); // tất cả project
        }
        Session::put('loaitailieu', $loaiTaiLieu);
        Session::put('dangxem', $dangxem);
        $linhVuc = new LinhVuc();
        $listLinhVuc = $linhVuc->get();
        return view('trangchu', ['getAll' => $listLinhVuc,'title'=>'Bán đồ án, dự án, luận văn tốt nghiệp bài tập lớn công nghệ thông tin']);
    }


    public function ChiTiet(Request $request)
    {
        $matailieu = $request->matailieu;
        $tailieu = TaiLieu::where('matailieu', $matailieu)->first(); // lấy ra 1 tài liệu
        TaiLieu::where('matailieu', $matailieu)->update(['soluotxem' => $tailieu->soluotxem + 1]);
        $listCungLoai = TaiLieu::where('maloai', $tailieu->maloai)->orderBy('gia', 'DESC')->take(5)->get();
        return view('chitietproject', ['getOne' => $tailieu, 'listCungLoai' => $listCungLoai,'title'=>'Chi tiết '.$tailieu->tentailieu]);
    }

    public function ThanhToan(Request $request)
    {
        $matailieu = $request->matailieu;
        $gia = $request->gia;
//        $soluotai = $request->soluottai;
        $khachhang = Session::get('khachhang');

        $soTienConLai = $khachhang->sodu - $gia;

        if ($soTienConLai < 0) {
            Session::put('thongbao', 'taixuongkhongthanhcong');
            return redirect('/thongbao');
        }

        $tailieu = TaiLieu::where('matailieu', $matailieu)->first();


        TaiLieu::where('matailieu', $matailieu)->update(['soluottai' => $tailieu->soluottai + 1]); // tang so luot tai
        TaiLieu::where('matailieu', $matailieu)->update(['soluotxem' => $tailieu->soluotxem + 1]); // tang so luot xem


        /**
         * Thêm tải xuống
         */
        $mataixuong = date('YmdHis');
        $thoigianhientai = date('Y-m-d H:i:s');
        $taixuong = new TaiXuong();
        $taixuong->mataixuong = $matailieu . $mataixuong;
        $taixuong->taikhoan = $khachhang->taikhoan;
        $taixuong->matailieu = $matailieu;
        $taixuong->thoigian = $thoigianhientai;

        $taixuong->save();


        $khachhang->sodu = $soTienConLai;
        KhachHang::where('taikhoan', $khachhang->taikhoan)->update(['sodu' => $soTienConLai]); // set lại số dư


        Session::put('khachhang', $khachhang);
        Session::put('thongbao', 'taixuong');
        Session::put('thongbaotaixuong', $tailieu);
        return redirect('/thongbao');
    }

}
