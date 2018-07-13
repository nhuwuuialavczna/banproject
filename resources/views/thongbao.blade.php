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
                giá {{Session::get('thongbaotaixuong')-> gia}}</h3>
            <p>Bạn hãy <a href="{{Session::get('thongbaotaixuong')-> link}}">Bấm vào đây để tải xuống</a></p>
            <p>Pass giải nén nếu có: <b>{{Session::get('thongbaotaixuong')-> passgianen}}</b></p>
        @endif

        <a class="btn btn-success" href="/">Về trang chủ</a>
    </div>
@endsection