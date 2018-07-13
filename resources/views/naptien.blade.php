@extends('menu')

@section('NoiDung')
    <div class="container">

        <div class="col-sm-4">
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