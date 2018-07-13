<?php

namespace App\Http\Controllers;

use App\KhachHang;
use App\LichSuNapTien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\MobiCard;
use App\Result;
use App\Config;


class AccountController extends Controller
{
    public function Login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $kh = KhachHang::where('taikhoan', $username)->first();
        if ($kh != null) {
            if ($kh->matkhau == $password) {

                if ($kh->role == 'admin') {
                    Session::put('khachhang', $kh);
                    return redirect('/');

                } else
                    if ($kh->role != 'user') {
                        Session::put('taikhoan', $username);
                        Session::put('thongbao', 'chuaxacnhan');
                        return redirect('/thongbao');
                    } else {
                        Session::put('khachhang', $kh);
                        return redirect('/');
                    }
            }
        }

        return view('dangnhap', ['tb' => 'Tài khoản hoặc mật khẩu không đúng']);
    }

    public function Register(Request $request)
    {
        $username = $request->user;
        $password = $request->pass;
        $email = $request->email;
        $sdt = $request->sdt;
        $ten = $request->ten;
        $maxacnhan = round(microtime(true) * 1000);

        $khachhang = new KhachHang();
        $khachhang->taikhoan = $username;
        $khachhang->matkhau = $password;
        $khachhang->email = $email;
        $khachhang->sodienthoai = $sdt;
        $khachhang->ten = $ten;
        $khachhang->sodu = 0;
        $khachhang->role = $maxacnhan;
        $khachhang->thoigiangianhap = 'no';
        $khachhang->save();

        Mail::send('mailtemplate', ['maxacnhan' => $maxacnhan], function ($message) use ($email) {
            $message->to($email, 'Bán project')->subject('Bán project');
        });
        Session::put('taikhoan', $username);

//        return view('xacnhan', ['tb' => 'Đã có 1 email gửi đến bạn. Nó chứa mã xác nhận tài khoản. Mời bạn kiểm tra và nhập mã xác nhận để tiến hành
//        xác thực tài khoản']);
        return redirect('/account/xacnhan');

    }

    public function TrangXacNhan()
    {
        return view('xacnhan', ['tb' => '']);
    }

    public function Logout()
    {
        Session::put('khachhang', null);
        return redirect('/');
    }


    public function XacNhan(Request $request)
    {
        $taikhoan = Session::get('taikhoan');
        $role = $request->maxacnhan;
        if ($taikhoan != null && $role != null) {
            $khachhang = KhachHang::find($taikhoan);

            if ($role == $khachhang->role) {
                KhachHang::where('taikhoan', $taikhoan)->update(['role' => 'user']);
                Session::put('khachhang', $khachhang);
            } else {
                return view('xacnhan', ['tb' => 'Xin nhận lại mã xác nhận vào bên dưới.']);
            }
        } else {
            return view('xacnhan', ['tb' => 'Xin nhận lại mã xác nhận và username (nếu có ô để nhập) vào bên dưới.']);
        }


        return redirect('/');
    }

    public function LayMatKhau(Request $request)
    {
        $email = $request->email;
        $kh = KhachHang::where('email', $email)->first();
        Mail::send('laymatkhau', ['mk' => $kh->matkhau], function ($message) use ($email) {
            $message->to($email, 'Bán project')->subject('Lấy lại mật khẩu');
        });
        Session::put('thongbao', 'laymatkhau');
        return view('thongbao');
    }


    public function CheckEmailAndCheckUsername(Request $request)
    {
        $taikhoan = $request->taikhoan;
        $email = $request->email;
        $khTaiKhoan = KhachHang::where('taikhoan', $taikhoan)->first();
        $khEmail = KhachHang::where('email', $email)->first();
        if ($khEmail != null) {
            return 'trungemail';
        }
        if ($khTaiKhoan != null) {
            return 'trungtaikhoan';
        }
        return 'ok';
    }

    //vzxvczxcvzxvc
    public function DoiMatKhau(Request $request)
    {
        $matkhau = $request->matkhaumoi;
        $kh = Session::get('khachhang');
        KhachHang::where('taikhoan', $kh->taikhoan)->update(['matkhau' => $matkhau]);
        return 'ok';
    }

    public function NapThe(Request $request)
    {
        $soseri = $request->txtSoSeri;
        $sopin = $request->txtSoPin;
        $type_card = $request->loaithe;
        $call = new MobiCard();


//        $arytype = array(92 => 'VMS', 93 => 'VNP', 107 => 'VIETTEL', 121 => 'VCOIN', 120 => 'GATE');
        //Tiến hành kết nối thanh toán Thẻ cào.
        $call = new MobiCard();
        $rs = new Result();
        $coin1 = rand(10, 999);
        $coin2 = rand(0, 999);
        $coin3 = rand(0, 999);
        $coin4 = rand(0, 999);
        $ref_code = $coin4 + $coin3 * 1000 + $coin2 * 1000000 + $coin1 * 100000000;


        $ngayGioHienTai = 'Thoi gian chua xac dinh';


        $rs = $call->CardPay($sopin, $soseri, $type_card, $ref_code, "", "", "");

        if ($rs->error_code != '00') {
            Session::put('thongbao', 'naptienkhongthanhcong');
            Session::put('thongbaokhongthanhcong', 'Hệ thống đang bảo trì');
            return redirect('/thongbao', ['tb' => '']);
        } else {
            $khachhang = Session::get('khachhang');
            $maphuongthuc = 'Nạp card';
            $soTienMoi = $khachhang->sodu + (int)$rs->card_amount;
            $khachhang->sodu = $soTienMoi;

            Session::put('khachhang', $khachhang);


            KhachHang::where('taikhoan', $khachhang->taikhoan)->update(['sodu' => $soTienMoi]);

            Session::put('thongbao', 'naptienthanhcong');
            Session::put('tbnaptienLoaiThe', 'Bạn vừa nạp thành công thẻ: ' . $rs->type_card);
            Session::put('tbnaptienSoTien', 'Số tiền nhận được: ' . $rs->card_amount);
            Session::put('tbnaptienThoiGian', 'Thời gian giao dịch: ' . $ngayGioHienTai);

            $lichSuNapTien = new LichSuNapTien();
            $lichSuNapTien->manaptien = $rs->card_serial;
            $lichSuNapTien->taikhoan = $khachhang->taikhoan;
            $lichSuNapTien->thoigiannaptien = $ngayGioHienTai;
            $lichSuNapTien->sotien = $rs->card_amount;
            $lichSuNapTien->maphuongthuc = $maphuongthuc;

            $lichSuNapTien->save();

            return redirect('/thongbao', ['tb' => '']);
        }

    }

}

