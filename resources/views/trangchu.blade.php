@extends('menu')
@section('NoiDung')
    <div class="container">

        <div class="col-sm-4">
            @foreach($getAll as $linhvuc)
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span
                                        class="glyphicon glyphicon-menu-hamburger"></span> {{$linhvuc->tenlinhvuc}}
                            </h3>
                        </div>
                        <div class="panel-body">
                            @foreach($linhvuc->getListLoai() as $loai)
                                <p><span class="glyphicon glyphicon-triangle-right"></span> <a
                                            href="/project/locproject?loaitailieu={{$loai->maloai}}&tenloai={{$loai->tenloai}}">{{$loai->tenloai}}</a>
                                    <span
                                            class="label label-info pull-right">434</span></p>
                            @endforeach

                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-sm-8">
            <div>
                <ol class="breadcrumb">
                    <li style="color: red"><b>{{Session::get('dangxem')}}</b></li>
                </ol>
            </div>
            <div class="row">
                <div class="btn-group alg-right-pad">
                    <button type="button" class="btn btn-default"><strong>{{count(Session::get('listTaiLieu'))}} </strong>project</button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Sắp xếp &nbsp;
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Giá cao nhất</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Giá thấp nhất</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Tải nhiều nhất</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Xem nhiều nhất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <!-- /.col -->
                @foreach(Session::get('listTaiLieu') as $project)
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
                                            <span class="glyphicon glyphicon-download-alt"></span> Tải xuống <span
                                                    class="badge">{{$project->soluottai}}</span> </a>
                                    @endif

                                    @if(Session::get('khachhang')!=null)
                                        @if(Session::get('khachhang')->sodu < $project-> gia)
                                            <a data-toggle="modal" data-target="#yeucaunaptien" class="btn btn-success"
                                               role="button">
                                                <span class="glyphicon glyphicon-download-alt"></span> Tải xuống <span
                                                        class="badge">{{$project->soluottai}}</span> </a>
                                        @else
                                            <a data-toggle="modal" data-target="#yeucauthanhtoan{{$project->matailieu}}"
                                               class="btn btn-success" role="button">
                                                <span class="glyphicon glyphicon-download-alt"></span> Tải xuống <span
                                                        class="badge">{{$project->soluottai}}</span> </a>
                                        @endif
                                    @endif

                                    <a href="/project/chitiet?matailieu={{$project->matailieu}}" class="btn btn-primary"
                                       role="button">
                                        <span class="glyphicon glyphicon-eye-open"></span> Xem chi tiết <span
                                                class="badge">{{$project->soluotxem}}</span> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- /.row -->
            <div class="row">
                <ul class="pagination alg-right-pad">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
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
    @foreach(Session::get('listTaiLieu') as $project)
        <div id="yeucauthanhtoan{{$project->matailieu}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thông báo</h4>
                    </div>
                    <div class="modal-body">
                        <p>- Bạn có muốn tải tài liệu này với giá {{$project->gia}} VNĐ. Bạn nên <a
                                    href="/project/chitiet?matailieu={{$project->matailieu}}">xem trước</a> project này
                            trước khi
                            tải</p>
                    </div>
                    <div class="modal-footer">
                        <a href="/project/thanhtoan?matailieu={{$project->matailieu}}&gia={{$project->gia}}&soluottai={{$project->soluottai}}">
                            <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span> Tiếp tục tải xuống</button>
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