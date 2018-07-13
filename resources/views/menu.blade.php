<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .alg-right-pad {
            float: right;
            padding-right: 20px;
        }
    </style>
    <!--  SEO -->
    <meta content='Nguyễn Tấn Hậu | Trang web bán project và đồ án uy tín' name='description' />
    <meta content='taiproject.herokuapp.com' property='og:url' />
    <meta content='NGUYỄN TẤN HẬU' property='og:title' />
    <meta content='Đồ án tốt nghiệp, luận văn, đồ án công nghệ thông tin, đồ án lớn, bài tập lớn công nghệ thông tin, project Spring MVC, project Spring boot, PHP, lavarel, javascript, Nguyễn Tấn Hậu, NodeJS, angularJS, angular 6, hibernate, .NET, .NET core, winforms, webforms, JavaFX, Bán tài liệu, bán đồ án, chia sẽ tài liệu chia sẽ đồ án, mua bán đồ án' property='og:description' />

    <meta name="description" content="Bán project, đồ án, bài tập lớn, phần mềm, ứng dụng di động, IOS" />
    <meta name="keywords" content="Đồ án tốt nghiệp, luận văn, đồ án công nghệ thông tin, đồ án lớn, bài tập lớn công nghệ thông tin, project Spring MVC, project Spring boot, PHP, lavarel, javascript, Nguyễn Tấn Hậu, NodeJS, angularJS, angular 6, hibernate, .NET, .NET core, winforms, webforms, JavaFX, Bán tài liệu, bán đồ án, chia sẽ tài liệu chia sẽ đồ án, mua bán đồ án" />
    <!--  SEO -->
    <script>
        $(document).ready(function () {
            $('#btnDoiMatKhau').on('click', function () {
                var matkhaumoi = $('#matkhaumoi').val();
                var nhaplaimatkhaumoi = $('#nhaplaimatkhaumoi').val();

                if (matkhaumoi === '') {
                    $('#matkhaumoi').css('border', '1px solid red');
                    $('#loidoimatkhau').html('Mật khẩu mới không được bỏ trống');
                    return;
                } else if (matkhaumoi.length < 6) {
                    $('#matkhaumoi').css('border', '1px solid red');
                    $('#loidoimatkhau').html('Mật khẩu mới không được nhỏ hơn 6 kí tự');
                    return;
                } else if (matkhaumoi !== nhaplaimatkhaumoi) {
                    $('#nhaplaimatkhaumoi').css('border', '1px solid red');
                    $('#loidoimatkhau').html('Nhập lại mật khẩu không đúng');
                    return;
                } else {
                    $('#loidoimatkhau').html('Đang đổi mật khẩu');
                    $('#matkhaumoi').css('border', '2px solid green');
                    $('#nhaplaimatkhaumoi').css('border', '2px solid green');

                    $.ajax({
                        url: '/account/doimatkhau?matkhaumoi=' + matkhaumoi,
                        type: 'get',
                        success: function (data) {
                            $('#loidoimatkhau').html('Đổi mật khẩu thành công');
                        },
                        error: function (err) {
                            $('#loidoimatkhau').html('Đã xảy ra lỗi nghiêm trọng');
                        }

                    });
                }

            });
            $('#formdoimatkhau').on('keyup', function () {
                var matkhaumoi = $('#matkhaumoi').val();
                var nhaplaimatkhaumoi = $('#nhaplaimatkhaumoi').val();

                if (matkhaumoi !== '') {
                    $('#matkhaumoi').css('border', '2px solid green');
                    $('#loidoimatkhau').html('');
                }

                if (nhaplaimatkhaumoi !== '') {
                    $('#nhaplaimatkhaumoi').css('border', '2px solid green');
                    $('#loidoimatkhau').html('');
                }
            });
        });
    </script>

</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid" style="background-color: black;color: white">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/"><span class="glyphicon glyphicon-home"></span> Trang chủ <span
                                class="sr-only">(current)</span></a></li>
                @if(Session::get('khachhang')!=null)
                    <li class="active"><a href="/naptien"><span class="glyphicon glyphicon-usd"></span> Nạp tiền</a></li>
                @endif

                <li class="active" class="dropdown">
                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><span class="glyphicon glyphicon-user"></span>
                        @if(Session::get('khachhang')!=null)
                            {{Session::get('khachhang')->taikhoan}}
                        @endif

                        @if(Session::get('khachhang')==null)
                            Tài khoản
                        @endif
                        <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(Session::get('khachhang')==null)
                            <li><a href="/dangnhap"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
                            <li><a href="/dangnhap"><span class="glyphicon glyphicon-plus-sign"></span> Đăng kí</a></li>
                        @endif

                        @if(Session::get('khachhang')!=null)

                            <li><a data-toggle="modal" data-target="#doimatkhau" href="#"><span
                                            class="glyphicon glyphicon-transfer"></span> Đổi mật khẩu</a></li>
                            <li><a href="/account/logout"><span class="glyphicon glyphicon-log-out"></span> Đăng
                                    xuất</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>

            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a class="btn btn-success" href="/xemtatca"><span class="glyphicon glyphicon-th-large"></span> Xem tất cả project</a></li>
                @if(Session::get('khachhang')!=null)
                    <li class="active"><a href="#">Số dư: {{Session::get('khachhang')->sodu}} VNĐ</a></li>
                @endif

                <li class="active"><a href="#"><span class="glyphicon glyphicon-phone-alt"></span> Liên hệ: 0966490297</a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div id="doimatkhau" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Đổi mật khẩu</h4>
            </div>
            <div class="modal-body">
                <form id="formdoimatkhau">
                    <label for="matkhaumoi">Nhập mật khẩu mới</label>
                    <input class="form-control" id="matkhaumoi" name="matkhaumoi" type="password"
                           placeholder="Mật khẩu mới">
                    <label for="nhaplaimatkhaumoi">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" name="nhaplaimatkhaumoi" id="nhaplaimatkhaumoi"
                           placeholder="Nhập lại mật khẩu mới">
                </form>
                <p style="color: red" id="loidoimatkhau"></p>

                <button type="submit" id="btnDoiMatKhau" value="" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Đổi mật khẩu</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@yield('NoiDung')
</body>
</html>