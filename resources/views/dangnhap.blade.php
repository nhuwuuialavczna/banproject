@extends('menu')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {
        $('#btnQuenMatKhau').on('click', function () {
            if ($('#email-qmk').val() === '') {
                $('#email-qmk').css('border', '1px solid red');
                $('#loiquenmatkhau').html('Không được bỏ trống trường này');
            } else {
                $('#loiquenmatkhau').html('Đang xử lý...');
                var email = $('#email-qmk').val();
                $.ajax({
                    url: '/account/checkemail?email=' + email,
                    type: 'get',
                    success: function (data) {
                        if (data === 'ok') {
                            $('#form-quenmatkhau').submit();
                        } else {
                            $('#email-qmk').css('border', '1px solid red');
                            $('#loiquenmatkhau').html('Email bạn nhập không tồn tại !');
                        }
                    },
                    error: function (err) {
                        $('#loiquenmatkhau').html('Đã xảy ra lỗi nghiêm trọng. Mời bạn kiểm tra lại !');
                    }

                });
            }
        });
        $('#form-quenmatkhau').on('keyup', function () {
            if ($('#email-qmk').val() !== '') {
                $('#email-qmk').css('border', '2px solid green');
                $('#loiquenmatkhau').html('');
            }
        });

        $('#btnDangKi').on('click', function () {

            var taikhoan = $('#user').val();
            var matkhau = $('#pass').val();
            var nhaplaimatkhau = $('#re-pass').val();
            var email = $('#email').val();
            var sdt = $('#sdt').val();
            var ten = $('#ten').val();

            if (taikhoan.length < 6) {
                $('#loidangki').html('Tài khoản không được bỏ trống hoặc dưới 6 kí tự');
                $('#user').css('border', '1px solid red');
            } else if (matkhau.length < 6) {
                $('#loidangki').html('Mật khẩu không được bỏ trống hoặc dưới 6 kí tự');
                $('#pass').css('border', '1px solid red');
            } else if (matkhau !== nhaplaimatkhau) {
                $('#loidangki').html('Nhập llaji mật khaair khoodng đúng');
                $('#re-pass').css('border', '1px solid red');
            } else if (!validateEmail(email)) {
                $('#loidangki').html('Email không hợp lệ');
                $('#email').css('border', '1px solid red');
            } else if (ten.length < 1) {
                $('#loidangki').html('Tên không được bỏ trống');
                $('#ten').css('border', '1px solid red');
            } else if (!phonenumber(sdt)) {
                $('#loidangki').html('Số điện thoại không hợp lệ');
                $('#sdt').css('border', '1px solid red');
            } else {
                $('#loidangki').html('Đang đăng kí. Quá trình sẽ hoàn tất sau chốc lát. Vui lòng đợi.');
                $.ajax({

                    url: '/account/checkEmailAndUsername?taikhoan=' + taikhoan + '&email=' + email,
                    type: 'get',
                    success: function (data) {
                        if (data === 'trungtaikhoan') {
                            $('#loidangki').html('Tài khoản đã tồn tại');
                            $('#user').css('border', '1px solid red');
                        } else if (data === 'trungemail') {
                            $('#loidangki').html('Email đã tồn tại');
                            $('#email').css('border', '1px solid red');
                        } else {
                            $('#register').submit();
                        }
                    },
                    error: function (error) {

                    }


                });
            }


        });
        $('#register').on('keyup', function () {

            var taikhoan = $('#user').val();
            var matkhau = $('#pass').val();
            var nhaplaimatkhau = $('#re-pass').val();
            var email = $('#email').val();
            var sdt = $('#sdt').val();
            var ten = $('#ten').val();

            if (taikhoan.length >= 6) {
                $('#user').css('border', '2px solid green');
                $('#loidangki').html('');
            }
            if (matkhau.length >= 6) {
                $('#pass').css('border', '2px solid green');
                $('#loidangki').html('');
            }
            if (matkhau === nhaplaimatkhau) {
                $('#re-pass').css('border', '2px solid green');
                $('#loidangki').html('');
            }
            if (validateEmail(email)) {
                $('#loidangki').html('');
                $('#email').css('border', '2px solid green');
            }
            if (ten.length >= 6) {
                $('#ten').css('border', '2px solid green');
                $('#loidangki').html('');
            }
            if (phonenumber(sdt)) {
                $('#sdt').css('border', '2px solid green');
                $('#loidangki').html('');
            }


        });
    });

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function phonenumber(inputtxt) {
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        return phoneno.test(String(inputtxt).toLowerCase());
    }
</script>

@section('NoiDung')
    <div class="container">

        <div class="col-sm-6">
            <h3>Đăng nhâp</h3>
            <form action="/account/dangnhap" id="login" method="post">
                <label for="username">Tên tài khoản</label>
                <input type="text" placeholder="Username" name="username" id="username" class="form-control"><br>
                <label for="password">Mật khẩu</label>
                <input type="password" placeholder="Password" name="password" id="password" class="form-control"><br>
                {{ csrf_field() }}
                <p style="color: red"> {{$tb}}</p>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</button>
                <a type="button" data-toggle="modal" data-target="#quenmatkhau" class="btn btn-success"><span class="glyphicon glyphicon-question-sign"></span> Quên mật
                    khẩu</a>
            </form>

        </div>
        <div class="col-sm-6">
            <h3>Đăng kí</h3>
            <form id="register" action="/account/register" method="post">
                <input type="text" placeholder="Tài khoản" id="user" name="user" class="form-control"><br>
                <input type="password" placeholder="Mật khẩu" id="pass" name="pass" class="form-control"><br>
                <input type="password" placeholder="Nhập lại mật khẩu" id="re-pass" name="pass" class="form-control"><br>
                <input type="text" placeholder="Email" id="email" name="email" class="form-control"><br>
                <input type="text" placeholder="Số điện thoại" id="sdt" name="sdt" class="form-control"><br>
                <input type="text" placeholder="Tên" id="ten" name="ten" class="form-control"><br>
                {{ csrf_field() }}

            </form>
            <p id="loidangki" style="color: red"></p>
            <button type="submit" id="btnDangKi" value="Đăng kí" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Đăng kí</button>
        </div>
    </div>

    <div id="quenmatkhau" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Đổi mật khẩu</h4>
                </div>
                <div class="modal-body">
                    <form id="form-quenmatkhau" action="/account/laymatkhau" method="get">
                        <label for="email-qmk">Nhập email của bạn</label>
                        <input class="form-control" id="email-qmk" name="email" type="email"
                               placeholder="Nhập email của bạn">
                        <p style="color: red" id="loiquenmatkhau"></p>
                    </form>
                    <input type="button" id="btnQuenMatKhau" value="Lấy lại mật khẩu" class="btn btn-success">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection