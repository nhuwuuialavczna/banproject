@extends('menu')

@section('NoiDung')
    <div class="container">

        <div class="col-sm-6">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span
                                    class="glyphicon glyphicon-menu-hamburger"></span> Qua tài khoản ngân hàng
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>- Số tài khoản: 314100002120655</p>
                        <p>- Chủ tài khoản: NGUYEN TAN HAU</p>
                        <p>- Các bạn chuyển khoản qua tài khoản trên và sau đó gọi lại cho mình để xác nhận nhé</p>
                        <p>- Khi chuyển khoảng các bạn sẽ được tặng thêm 10% số tiền nạp</p>
                    </div>
                </div>


            </div>
            <hr style="border: 2px solid black">
            <div class="row">
                <h3>Nạp tiền bằng thẻ cào (Đang bảo trì)</h3>
                <hr>
                <form action="napthe">
                    <label for="loaithe">Chọn loại thẻ cào</label>
                    <select name="loaithe" class="form-control" id="loaithe">
                        <option value="VMS">Mobifone</option>
                        <option value="VNP">Vinaphone</option>
                        <option value="VIETTEL">Viettel</option>
                        <option value="VCOIN">VTC</option>
                        <option value="GATE">Gate</option>
                    </select>
                    <label for="seri">Nhập số seri</label>
                    <input type="text" class="form-control" id="txtSoSeri" name="txtSoSeri" placeholder="Số seri">
                    <label for="sothe">Nhập mã thẻ cào</label>
                    <input type="text" class="form-control" id="txtSoPin" name="txtSoPin" placeholder="Mã số thẻ"><br>
                    <input type="submit" disabled class="btn btn-success" value="Nạp thẻ">
                </form>
                <p><b>- Chú ý: Các bạn sẽ mất 25% giá trị thẻ nạp với tất cả nhà mạng</b></p>
            </div>

        </div>
        <div class="col-sm-6">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span
                                    class="glyphicon glyphicon-menu-hamburger"></span> Lịch sử tải xuống
                        </h3>
                    </div>
                    <div class="panel-body">

                        @foreach($lichSuTaiXuong as $lstx)
                            <p><span class="glyphicon glyphicon-triangle-right"></span>
                                {{$lstx->getTaiLieu()['tentailieu']}}
                                <span class="label label-info pull-right">{{$lstx->getTaiLieu()['gia']}} VNĐ</span></p>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span
                                    class="glyphicon glyphicon-menu-hamburger"></span> Lịch sử nạp tiền
                        </h3>
                    </div>
                    <div class="panel-body">
                        @foreach($lichSu as $ls)
                            <p><span class="glyphicon glyphicon-triangle-right"></span> {{$ls->sotien}} VNĐ
                                - {{$ls->maphuongthuc}}
                                <span class="label label-info pull-right">{{$ls->thoigiannaptien}}</span></p>
                        @endforeach

                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection