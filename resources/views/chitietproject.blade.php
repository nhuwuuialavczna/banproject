@extends('menu')
@section('NoiDung')



    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3>Bạn đang xem tài liệu {{$getOne->tentailieu}}</h3>
                <h3>Giá tài liệu: {{$getOne->gia}} </h3>
                @if(Session::get('khachhang')==null)
                    <a data-toggle="modal" data-target="#yeucaudangnhap" class="btn btn-success"
                       role="button">
                        <span class="glyphicon glyphicon-download-alt"></span> Tải xuống <span
                                class="badge">{{$getOne->soluottai}}</span> </a>
                @endif

                @if(Session::get('khachhang')!=null)
                    @if(Session::get('khachhang')->sodu < $getOne-> gia)
                        <a data-toggle="modal" data-target="#yeucaunaptien" class="btn btn-success"
                           role="button">
                            <span class="glyphicon glyphicon-download-alt"></span> Tải xuống <span
                                    class="badge">{{$getOne->soluottai}}</span> </a>
                    @else
                        <a data-toggle="modal" data-target="#yeucauthanhtoan{{$getOne->matailieu}}"
                           class="btn btn-success" role="button">
                            <span class="glyphicon glyphicon-download-alt"></span> Tải xuống <span
                                    class="badge">{{$getOne->soluottai}}</span> </a>
                    @endif
                @endif
                <hr>
                <iframe width="100%" height="273" src="{{$getOne->mota}}" frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen></iframe>
            </div>
            <div class="col-sm-6">
                <div align="center">
                    <h3 style="border-bottom: 2px black">
                        Các project liên quan
                    </h3>
                </div>
                @foreach($listCungLoai as $project)
                    <div class="text-center col-sm-6">
                        <div class="thumbnail product-box">
                            <img class="img-responsive" style="width:100%; height:100%" src="{{$project->hinhanhmota}}"
                                 alt=""/>
                            <div class="caption">
                                <h4><a href="#">{{$project->tentailieu}} </a></h4>
                                <p>Giá : <strong>{{$project->gia}} VNĐ</strong></p>
                                <p>
                                    @if(Session::get('khachhang')==null)
                                        <a data-toggle="modal" data-target="#yeucaudangnhap" class="btn btn-success"
                                           role="button">
                                            <span class="glyphicon glyphicon-download-alt"></span> <span
                                                    class="badge">{{$project->soluottai}}</span> </a>
                                    @endif

                                    @if(Session::get('khachhang')!=null)
                                        @if(Session::get('khachhang')->sodu < $project-> gia)
                                            <a data-toggle="modal" data-target="#yeucaunaptien" class="btn btn-success"
                                               role="button">
                                                <span class="glyphicon glyphicon-download-alt"></span> <span
                                                        class="badge">{{$project->soluottai}}</span> </a>
                                        @else
                                            <a data-toggle="modal" data-target="#yeucauthanhtoan{{$project->matailieu}}"
                                               class="btn btn-success" role="button">
                                                <span class="glyphicon glyphicon-download-alt"></span> <span
                                                        class="badge">{{$project->soluottai}}</span> </a>
                                        @endif
                                    @endif

                                    <a href="/project/chitiet?matailieu={{$project->matailieu}}" class="btn btn-primary"
                                       role="button">
                                        <span class="glyphicon glyphicon-eye-open"></span> <span
                                                class="badge">{{$project->soluotxem}}</span> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="yeucaudangnhap" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông báo</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn phải <a class="btn btn-success" href="/dangnhap"> đăng nhập </a> trước khi tải tài liệu này
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    @foreach($listCungLoai as $project)
        <div id="yeucauthanhtoan{{$project->matailieu}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thông báo</h4>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn tải tài liệu này với giá {{$project->gia}} VNĐ. Bạn nên <a
                                    href="/project/chitiet?matailieu={{$project->matailieu}}">
                                <button type="button" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-eye-open"></span> Xem trước
                                </button></a> project này
                            trước khi
                            tải</p>
                    </div>
                    <div class="modal-footer">
                        <a href="/project/thanhtoan?matailieu={{$project->matailieu}}&gia={{$project->gia}}&soluottai={{$project->soluottai}}">
                            <button type="button" class="btn btn-success"><span
                                        class="glyphicon glyphicon-download-alt"></span> Tiếp tục tải xuống
                            </button>
                        </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div id="yeucaunaptien" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông báo</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn không đủ tiền để tải xuống tài liệu này. Yêu cầu bạn <a class="btn btn-success"
                                                                                   href="/naptien">nạp tiền</a>
                        vào
                        tài khoản</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

@endsection