@extends('menu')

@section('NoiDung')
    <div class="container">
        @if(Session::get('thongbao') == 'chuaxacnhan')
            <p>Tài khoản chưa xác nhận. Mời bạn truy cập <a href="/account/xacnhan">VÀO ĐÂY</a> và vào mail đăng kí để
                lấy mã
                xác
                nhận</p>

        @endif

        @if(Session::get('thongbao')== 'laymatkhau')
            <p>Bạn vừa yêu cầu lấy lại mật khẩu. Hãy vào mail đi, có 1 mật khẩu vừa được gửi đến bạn</p>
        @endif

        @if(Session::get('thongbao')== 'taixuong')
            <h3>Bạn vừa tải xuống tài liệu {{Session::get('thongbaotaixuong')-> tentailieu}} với
                giá {{Session::get('thongbaotaixuong')-> gia}} VNĐ</h3>
            <p>Bạn hãy <a href="{{Session::get('thongbaotaixuong')-> link}}">Bấm vào đây để tải xuống</a></p>
            <p>Pass giải nén nếu có: <b>{{Session::get('thongbaotaixuong')-> passgianen}}</b></p>
        @endif

        @if(Session::get('thongbao')== 'naptienthanhcong')
            <h3>{{Session::get('tbnaptienLoaiThe')}}</h3>
            <p>{{Session::get('tbnaptienSoTien')}}</p>
            <p>{{Session::get('tbnaptienThoiGian')}}</p>
        @endif

        @if(Session::get('thongbao')== 'naptienkhongthanhcong')
            <h3>{{Session::get('thongbaokhongthanhcong')}}</h3>
        @endif

        @if(Session::get('thongbao')== 'taixuongkhongthanhcong')
            <h3>Xin lỗi. Bạn đã cố gắng truy cập vào trong khi không đủ tiền để project này. Bạn hãy đăng nhập và nạp
                tiền</h3>
        @endif
        <a class="btn btn-success" href="/">Về trang chủ</a>
    </div>
@endsection