@extends('menu')

@section('NoiDung')
    <div class="container">

        <div class="col-sm-4">
            <h3>Nạp tiền bằng thẻ cào</h3>
            <hr>
            <form action="">
                <label for="loaithe">Chọn loại thẻ cào</label>
                <select name="loaithe" class="form-control" id="loaithe">
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <label for="seri">Chọn loại thẻ cào</label>
                <input type="text" class="form-control" name="seri" id="seri" placeholder="Số seri">
                <label for="sothe">Chọn loại thẻ cào</label>
                <input type="text" class="form-control" id="sothe" name="sothe" placeholder="Mã số thẻ"><br>
                <input type="submit" class="btn btn-success" value="Nạp thẻ">
            </form>
            <p><b>- Chú ý: Các bạn sẽ mất 25% giá trị thẻ nạp với tất cả nhà mạng</b></p>
        </div>
        <div class="col-sm-4">
            <h3>Qua tài khoản ngân hàng</h3>
            <hr>
            <p>- Số tài khoản: 314100002120655</p>
            <p>- Chủ tài khoản: NGUYEN TAN HAU</p>
            <p>- Các bạn chuyển khoản qua tài khoản trên và sau đó gọi lại cho mình để xác nhận nhé</p>
            <p>- Khi chuyển khoảng các bạn sẽ được tặng thêm 10% số tiền nạp</p>
        </div>
        <div class="col-sm-4">
            <h3>Lịch sử nạp tiền</h3>
            <hr>
        </div>

    </div>
@endsection