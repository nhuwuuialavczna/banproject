@extends('menu')

@section('NoiDung')
    <div class="container">


        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h3>
                {{$tb}}
            </h3>
            <form action="/account/xacnhan" method="get">
                @if(Session::get('taikhoan')!=null)
                    <input type="text" name="username" class="form-control" value="{{Session::get('taikhoan')}}"
                           style="display: none"><br>
                @endif

                @if(Session::get('taikhoan')==null)
                    <input type="text" name="username" class="form-control" placeholder="Mời bạn nhập tên tài khoản"
                          ><br>
                @endif

                <label for="maxacnhan">Nhập mã xác nhận của bạn</label><br>
                <input type="text" id="maxacnhan" class="form-control" name="maxacnhan" placeholder="Mã xác nhận"><br>
                <input type="submit" class="btn btn-success" value="Xác nhận">
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
@endsection