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


Route::get('/home', function () {
        return view('home');

});
Route::get('/', function () {
    return view('welcome');

});


Route::group(['prefix' => 'total','as' => 'total.'], function(){
    Route::get('/cuisine','TotalController@cuisine') -> name('cuisine');
    Route::get('/conferences','TotalController@conferences') -> name('conferences');
    Route::get('/spa','TotalController@spa') -> name('spa');
    Route::get('/contact_us','TotalController@contact_us') -> name('contact_us');
});



//Send mail
use App\Mail\WelcomeMail;
use \Illuminate\Support\Facades\Mail;
Route::get('/email', function () {
    $data = [];
    Mail::to('kimoanh20303@gmail.com')->send(new WelcomeMail($data));
    return new WelcomeMail($data);
});
Route::get('send-email', 'EmailController@sendEMail');

//comment
Route::group(['prefix' => 'comment','as' => 'comment.'], function() {
    Route::post('/', 'CommentController@comment')->name('comment');
//    Route::any('/storeCommentAjax','CommentController@storeCommentAjax')->name('storeCommentAjax');
});

/*
//Customer

Route::group(['prefix' => 'customer','as' => 'customer.'], function(){
    Route::get('/','CustomerController@index') -> name('index');
    Route::get('/create','CustomerController@create') -> name('create');//register
    Route::post('/store','CustomerController@store') -> name('store');
    Route::get('/edit/{id}','CustomerController@edit') ->name('edit');//change pass
    Route::post('/update/{id}','CustomerController@update') ->name('update');
    Route::post('/delete/{id}','CustomerController@destroy') ->name('destroy');
    Route::get('/detail/{id}','CustomerController@show') ->name('show');
});

Route::group(['prefix' => 'room','as' => 'room.'], function(){
    Route::get('/','RoomController@index') -> name('index');
    Route::get('/create','RoomController@create') -> name('create');
    Route::post('/store','RoomController@store') -> name('store');
    Route::get('/edit/{id}','RoomController@edit') ->name('edit');
    Route::post('/update/{id}','RoomController@update') ->name('update');
    Route::post('/delete/{id}','RoomController@destroy') ->name('destroy');
    Route::get('/detail/{id}','RoomController@show') ->name('show');
});

Route::group(['prefix' => 'slider','as' => 'slider.'], function(){
    Route::get('/create/{id}', 'SliderController@create')->name('create');
    Route::post('/store','SliderController@store') ->name('store');
    Route::get('/edit/{id}','SliderController@edit') ->name('edit');
    Route::get('/detail/{id}','SliderController@show') ->name('show');
    Route::post('/deleteimg/{id}','SliderController@deleteimg') ->name('destroyimg');
    Route::post('/delete/{id}','SliderController@destroy') ->name('destroy');
});

Route::group(['prefix' => 'search-room','as' => 'search-room.'], function(){
    Route::get('/', 'SearchRoomController@index')->name('find_rooms');
});

Route::group(['prefix' => 'select-room','as' => 'select-room.'], function(){
    Route::get('/', 'SelectRoomController@index')->name('index');
    Route::get('/delete','SelectRoomController@destroy') ->name('destroy');
});


Route::group(['prefix' => 'booking','as' => 'booking.'], function(){
    Route::get('/','BookingController@index') -> name('index');
});

Route::group(['prefix' => 'booking_detail','as' => 'booking_detail.'], function(){
    Route::get('/','BookingDetailController@index') -> name('index');
    Route::get('/create','BookingDetailController@create') -> name('create');
    Route::post('/store','BookingDetailController@store') -> name('store');
    Route::get('/edit/{id}','BookingDetailController@edit') ->name('edit');
    Route::post('/update/{id}','BookingDetailController@update') ->name('update');
    Route::post('/delete/{id}','BookingDetailController@destroy') ->name('destroy');
    Route::get('/detail/{id}','BookingDetailController@show') ->name('show');
});
*/



Route::get('/', 'HomeController@index')->name('home');

//Route::get('/', function () {
//    return view('welcome');
//});


Auth::routes();
//Customer site
Route::get('/login', 'LoginController@showLogin')->name('show-login');
Route::post('/handle-login','LoginController@handleLogin')->name('handle-login');//xử lý login
Route::get('/logout', 'LoginController@logout')->name('logout');

//reset password
Route::get('/reset-password', 'LoginController@reset')->name('reset');
Route::post('/reset_password_without_token', 'LoginController@validatePasswordRequest');
Route::get('/resetPassword/{token}', 'LoginController@resetPassword');
Route::post('/newPassword', 'LoginController@newPassword');


//Customer
Route::group(['prefix' => 'customer','as' => 'customer.'], function(){
    Route::get('/create','CustomerController@create') -> name('create');//register
    Route::post('/store','CustomerController@store') -> name('store');
    Route::get('/edit','CustomerController@edit') ->name('edit');//change pass
    Route::post('/update/{id}','CustomerController@update') ->name('update');
    Route::get('/detail/{id}','CustomerController@show') ->name('show');//information customer
});

Route::group(['prefix' => 'room','as' => 'room.'], function(){
    Route::get('/','RoomController@index') -> name('index');
    Route::get('/detail/{id}','RoomController@show') ->name('show');
});

Route::group(['prefix' => 'slider','as' => 'slider.'], function(){
    Route::get('/detail/{id}','SliderController@show') ->name('show');
});

Route::group(['prefix' => 'search-room','as' => 'search-room.'], function(){
    Route::get('/', 'SearchRoomController@index')->name('find_rooms');
});

Route::group(['prefix' => 'select-room','as' => 'select-room.'], function(){
    Route::get('/', 'SelectRoomController@index')->name('index');
    Route::get('/delete','SelectRoomController@destroy') ->name('destroy');
});


Route::group(['prefix' => 'booking','as' => 'booking.'], function(){
    Route::get('/','BookingController@index') -> name('index');
});

Route::group(['prefix' => 'booking_detail','as' => 'booking_detail.'], function(){
    Route::get('/create','BookingDetailController@create') -> name('create');
    Route::post('/store','BookingDetailController@store') -> name('store');
    Route::get('/detail/{id}','BookingDetailController@show') ->name('show');
});
//Admin site
Route::group(['prefix' => 'admin' , 'as' => 'admin.' ,'namespace' => 'Admin'],function (){
//'namespace' => 'Admin' == thư mục Admin (Controllers/Admin)
    Route::get('/login', 'LoginController@showLogin')->name('show-login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::post('/handle-login','LoginController@handleLogin')->name('handle-login');//xử lý login
    Route::group(['middleware' => 'admin-check-login'],function ()
    {
        Route::get('/','DashboardController@index')->name('dashboard');

        Route::group(['prefix' => 'customer','as' => 'customer.'], function() {
            Route::get('/', 'CustomerController@index')->name('index');
        });

        Route::group(['prefix' => 'room','as' => 'room.'], function(){
            Route::get('/','RoomController@index') -> name('index');
            Route::get('/create','RoomController@create') -> name('create');
            Route::post('/store','RoomController@store') -> name('store');
            Route::get('/edit/{id}','RoomController@edit') ->name('edit');
            Route::post('/update/{id}','RoomController@update') ->name('update');
            Route::post('/delete/{id}','RoomController@destroy') ->name('destroy');
            Route::get('/detail/{id}','RoomController@show') ->name('show');
            Route::get('/report','RoomController@report') ->name('report');
        });

        Route::group(['prefix' => 'slider','as' => 'slider.'], function(){
            Route::get('/create/{id}', 'SliderController@create')->name('create');
            Route::post('/store','SliderController@store') ->name('store');
            Route::get('/edit/{id}','SliderController@edit') ->name('edit');
            Route::get('/detail/{id}','SliderController@show') ->name('show');
            Route::post('/deleteimg/{id}','SliderController@deleteimg') ->name('destroyimg');
            Route::post('/delete/{id}','SliderController@destroy') ->name('destroy');
        });

        Route::group(['prefix' => 'booking','as' => 'booking.'], function(){
            Route::get('/','BookingController@index') -> name('index');
        });

        Route::group(['prefix' => 'booking_detail','as' => 'booking_detail.'], function(){
            Route::get('/','BookingDetailController@index') -> name('index');
            Route::get('/detail/{id}','BookingDetailController@show') ->name('show');
        });
    });

});





