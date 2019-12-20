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

Route::get('/', function () {
    return view('welcome');
});

//闭包路由
Route::get('/hello',function(){
	echo 123;
});

//路由视图
Route::get('/test',function(){
	return view('test');
});

//post路由
// Route::post('/doForm',function(){
// 	$post = request()->post();
// 	dd($post);
// });

Route::view('/lianxi','lianxi');

Route::get('/reg1','Reg@index');

Route::post('/doForm','Reg@doForm');

//Route::get('goods/{goods_id?}',"Reg@goods");

Route::redirect('/reg1','/hello');

Route::get('show/{id}',function($id){
    echo $id;
})->where('id','[\d]+');

Route::get('show2/{name}',function($name){
    echo $name;
})->where('name','[A-Za-z]+');

Route::get('show3/{id}/{name}',function($id,$name){
    echo $id;
    echo $name;
});

//Cookie
Route::get('/setcookie',function(){
    //队列设置cookie
    //Cookie::queue(Cookie::make('name', '白钢在猪圈', 2));
    Cookie::queue('username', '123', 2);
    //获取
    //$name = request()->cookie('name');
    //$name = Illuminate\Support\Facades\Cookie::get('username');
    //echo $name;
    //设置
    //return response('欢迎来到 Laravel 学院')->cookie('name', '学院君', 2);
});

Route::get('/cookie',function(){
    //获取
    //$name = request()->cookie('name');
    $name = Illuminate\Support\Facades\Cookie::get('username');
    echo $name;
    //设置
    //return response('欢迎来到 Laravel 学院')->cookie('name', '学院君', 2);
});
//后台

    //品牌
    Route::prefix('brand/')->group(function () {
        Route::get('create', 'Admin\Brand@create');
        Route::post('store', 'Admin\Brand@store');
        Route::get('index', 'Admin\Brand@index');
        Route::get('delete/{id}', 'Admin\Brand@destroy');
        Route::get('edit/{id}', 'Admin\Brand@edit');
        Route::post('update/{id}', 'Admin\Brand@update');
        Route::post('checkOnly', 'Admin\Brand@checkOnly');
    });
    //管理员
    Route::prefix('admin/')->group(function () {
        Route::get('create', 'Admin\AdminController@create');
        Route::post('store', 'Admin\AdminController@store');
        Route::get('index', 'Admin\AdminController@index')->middleware('CheckLogin');
        Route::get('delete/{id}', 'Admin\AdminController@destroy');
        Route::get('edit/{id}', 'Admin\AdminController@edit');
        Route::post('update/{id}', 'Admin\AdminController@update');
    });
    //分类
    Route::prefix('cate/')->group(function () {
        Route::get('create', 'Admin\CateController@create');
        Route::post('store', 'Admin\CateController@store');
        Route::get('index', 'Admin\CateController@index');
        Route::get('delete/{id}', 'Admin\CateController@destroy');
        Route::get('edit/{id}', 'Admin\CateController@edit');
    });
    //商品
    Route::prefix('goods/')->group(function () {
        Route::get('create', 'Admin\GoodsController@create');
        Route::post('store', 'Admin\GoodsController@store');
        Route::get('index', 'Admin\GoodsController@index');
        Route::get('delete/{id}', 'Admin\CateController@destroy');
    });

//登陆 注册
//Route::get('login/index','Admin\LoginController@login');
//Route::post('login/loginDo','Admin\LoginController@loginDo');
//Route::view('/reg','reg');
//Route::post('reg/doReg','Admin\LoginController@doReg');

//自动生成的登陆
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//文章
Route::prefix('/article/')->middleware('auth')->group(function() {
    Route::get('create', 'Admin\ArticleController@create');
    Route::post('store', 'Admin\ArticleController@store');
    Route::get('index', 'Admin\ArticleController@index');
    Route::post('delete', 'Admin\ArticleController@delete');
    Route::get('edit/{id}', 'Admin\ArticleController@edit');
    Route::post('update/{id}', 'Admin\ArticleController@update');
    Route::post('checkOnly','Admin\ArticleController@checkOnly');
});

//前台
//登陆
Route::view('/login','index.login.login');
Route::view('/reg','index.login.reg');
Route::post('/send','Index\LoginController@send');
Route::post('/do_reg','Index\LoginController@do_reg');
Route::post('/do_login','Index\LoginController@do_login');
//展示  详情  购物车
Route::get('/','Index\IndexController@Index');
Route::get('/detail/{goods_id}','Index\IndexController@detail');
Route::get('/car','Index\IndexController@car');
Route::get('/carDo','Index\IndexController@carDo');
Route::post('/ChangeNum','Index\IndexController@ChangeNum');
Route::post('/getTotal','Index\IndexController@getTotal');
Route::get('/getCount','Index\IndexController@getCount');
Route::get('/cart/delete','Index\IndexController@delete');
Route::get('/jiesuan','Index\OrderController@index');
//订单


//收获地址
Route::get('/addres','Index\AddressController@addres');
Route::get('/address','Index\AddressController@index');

Route::any('/getArea/','Index\AddressController@getArea');
Route::any('/save/','Index\AddressController@save');
//zhoukao
Route::get('/users','Admin\UsersController@index');
Route::post('/create','Admin\UsersController@create');
Route::get('/list','Admin\UsersController@list');
Route::get('/deletes/{id}','Admin\UsersController@delete');

Route::get('/AdminGoods','Admin\AdminGoodosController@index');
Route::post('/creates','Admin\AdminGoodosController@create');
Route::get('/zhanshi','Admin\AdminGoodosController@zhanshi');

Route::any('/user','Index\AddressController@user');
//模拟学生
Route::get('/student/index','Moni\StudentController@index');