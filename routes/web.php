<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

$email = '15130052@st.hcmuaf.edu.vn';

Route::get('/', 'HomeController@Index');
Route::get('/dangnhap', 'HomeController@DangNhap');
Route::get('/naptien', 'HomeController@NapTien');
Route::get('/thongbao', 'HomeController@ThongBao');

//Route::get('/demo', function () {
//    $listLoai = App\LoaiTaiLieu::find('SpringMVC')->getLinhVuc();
//    var_dump($listLoai);
//});


//Route::get('/demo', function () {
//    $listLoai = App\LinhVuc::find('Java')-> getListLoai();
//    var_dump($listLoai);
//});

Route::group(['prefix' => 'account'], function () {
    Route::post('dangnhap', 'AccountController@Login');
    Route::post('register', 'AccountController@Register');
    Route::get('logout', 'AccountController@Logout');
    Route::get('xacnhan', 'AccountController@XacNhan');
    Route::get('trangxacnhan', 'AccountController@TrangXacNhan');

    Route::get('doimatkhau', 'AccountController@DoiMatKhau');

    Route::get('laymatkhau', 'AccountController@LayMatKhau');
    Route::get('checkemail', 'AccountController@CheckEmail');
    Route::get('checkEmailAndUsername', 'AccountController@CheckEmailAndCheckUsername');

});


Route::group(['prefix' => 'project'], function () {
    Route::get('locproject', 'ProjectController@LocProject');
    Route::get('chitiet', 'ProjectController@ChiTiet');
    Route::get('thanhtoan', 'ProjectController@ThanhToan');
});