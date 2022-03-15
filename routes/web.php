<?php
namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Route;
/*********************************
admin
*********************************/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\OrderController;
/*********************************
frontend
*********************************/
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\NotifyController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use Symfony\Component\Routing\Route as RoutingRoute;

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

Route::get('/',                             [HomeController::class, 'index'])->name('slider');

//!=================================================== ADMIN =======================================================

$prefixAdmin = config('zvn.url.prefix_admin');
Route::group(['prefix' => $prefixAdmin,'namespace' => 'Admin','middleware'=>['permission.admin']], function () use ($prefixAdmin) {//middleware giới hạn member không vào được admin

    //===== DASHBOARD ======
    $prefix     = '';
    $controller = DashboardController::class;
    Route::group(['prefix' => $prefix], function () use ($controller) {
        Route::get('/',                             [$controller, 'index'])->name("dashboard");
    });
    //===== SLIDER ======
    $prefix     = 'slider';
    $controller = SliderController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {

        Route::get('/',                             [$controller, 'index'])->name($prefix);
        Route::get('/form',                         [$controller, 'form'])->name("$prefix/form");
        // Route::get('/form/{id?}',                   [$controller, 'form'])->name("$prefix/form");
        Route::get('/edit/{id?}',                   [$controller, 'edit'])->name("$prefix/edit");
        Route::post('/update/{id?}',                [$controller, 'update'])->name("$prefix/update");
        Route::get('/add',                          [$controller, 'add'])->name("$prefix/add");
        Route::post('/save',                        [$controller, 'save'])->name("$prefix/save");
        Route::get('/delete/{id?}',                 [$controller, 'delete'])->name("$prefix/delete");
        Route::post('/action',                      [$controller, 'action'])->name("$prefix/action");
        Route::get('/status=active',                [$controller, 'showActive'])->name("$prefix/showActive");
        Route::get('/status=inactive',              [$controller, 'showInactive'])->name("$prefix/showInactive");
        Route::get('/change-status-{status}/{id?}', [$controller, 'status'])->name("$prefix/status")->where('id', '[0-9]+');
        // Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    // //===== BANNER ======
    // $prefix     = 'banner';
    // $controller = BannerController::class;
    // Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {

    //     Route::get('/',                             [$controller, 'index'])->name("$prefix");
    //     Route::get('/form/{id?}',                   [$controller, 'form'])->name("$prefix/form");
    //     Route::get('/save',                         [$controller, 'save'])->name("$prefix/save");
    //     Route::get('/delete/{id}',                  [$controller, 'delete'])->name("$prefix/delete");
    //     Route::get('/change-status-{status}/{id}',  [$controller, 'status'])->name("$prefix/status")->where('id', '[0-9]+');
    // });

    //======= USER ========
    $prefix         = 'user';
    $controller = UserController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {

        Route::get('/',                                 [$controller, 'index'])->name($prefix);
        Route::get('/form',                             [$controller, 'form'])->name("$prefix/form");
        // Route::get('/form/{id?}',                    [$controller, 'form'])->name("$prefix/form");
        Route::get('/edit/{id?}',                       [$controller, 'edit'])->name("$prefix/edit");
        Route::post('/update/{id?}',                    [$controller, 'update'])->name("$prefix/update");
        Route::get('/add',                              [$controller, 'add'])->name("$prefix/add");
        Route::post('/save',                            [$controller, 'save'])->name("$prefix/save");
        Route::get('/delete/{id?}',                     [$controller, 'delete'])->name("$prefix/delete");
        Route::post('/action',                          [$controller, 'action'])->name("$prefix/action");
        Route::get('/status=active',                    [$controller, 'showActive'])->name("$prefix/showActive");
        Route::get('/status=inactive',                  [$controller, 'showInactive'])->name("$prefix/showInactive");
        Route::get('/change-status-{status}/{id?}',     [$controller, 'status'])->name("$prefix/status")->where('id', '[0-9]+');
        // Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    //======= CATEGORY ========
    $prefix         = 'category';
    $controller = CategoryController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {

        Route::get('/',                                 [$controller, 'index'])->name($prefix);
        // Route::get('/form/{id?}',                    [$controller, 'form'])->name("$prefix/form");
        Route::get('/edit/{id?}',                       [$controller, 'edit'])->name("$prefix/edit");
        Route::post('/update/{id?}',                    [$controller, 'update'])->name("$prefix/update");
        Route::get('/add',                              [$controller, 'add'])->name("$prefix/add");
        Route::post('/save',                            [$controller, 'save'])->name("$prefix/save");
        Route::get('/delete/{id?}',                     [$controller, 'delete'])->name("$prefix/delete");
        Route::post('/action',                          [$controller, 'action'])->name("$prefix/action");
        Route::get('/status=active',                    [$controller, 'showActive'])->name("$prefix/showActive");
        Route::get('/status=inactive',                  [$controller, 'showInactive'])->name("$prefix/showInactive");
        Route::get('/change-status-{status}/{id?}',     [$controller, 'status'])->name("$prefix/status")->where('id', '[0-9]+');
        Route::get('/change-display-{display}/{id?}',   [$controller, 'display'])->name("$prefix/display")->where('id', '[0-9]+');
        Route::post('/category-{id?}-order',            [$controller, 'orderItem'])->name("$prefix.category.order");
        // Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    //======= PRODUCT ========
    $prefix         = 'product';
    $controller = ProductController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {
        Route::get('/',                                 [$controller, 'index'])->name($prefix);
        Route::post('/exportProduct',                   [$controller, 'exportProduct'])->name('exportProduct');
        Route::get('/edit/{id?}',                       [$controller, 'edit'])->name("$prefix/edit");
        Route::post('/update/{id?}',                    [$controller, 'update'])->name("$prefix/update");
        Route::get('/add',                              [$controller, 'add'])->name("$prefix/add");
        Route::post('/save',                            [$controller, 'save'])->name("$prefix/save");
        Route::get('/delete/{id?}',                     [$controller, 'delete'])->name("$prefix/delete");
        Route::post('/action',                          [$controller, 'action'])->name("$prefix/action");
        // Route::get('/status=active',                    [$controller, 'showActive'])->name("$prefix/showActive");
        // Route::get('/status=inactive',                  [$controller, 'showInactive'])->name("$prefix/showInactive");
        Route::get('/change-status-{status}/{id?}',     [$controller, 'status'])->name("$prefix/status")->where('id', '[0-9]+');
        Route::get('/change-type-{type}/{id?}',         [$controller, 'type'])->name("$prefix/type")->where('id', '[0-9]+');
        // Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    //======= POST ========
    $prefix         = 'post';
    $controller = AdminPostController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {

        Route::get('/',                                 [$controller, 'index'])->name($prefix);
        // Route::get('/form',                             [$controller, 'form'])->name("$prefix/form");
        // Route::get('/form/{id?}',                    [$controller, 'form'])->name("$prefix/form");
        Route::get('/edit/{id?}',                       [$controller, 'edit'])->name("$prefix/edit");
        Route::post('/update/{id?}',                    [$controller, 'update'])->name("$prefix/update");
        Route::get('/add',                              [$controller, 'add'])->name("$prefix/add");
        Route::post('/save',                            [$controller, 'save'])->name("$prefix/save");
        Route::get('/delete/{id?}',                     [$controller, 'delete'])->name("$prefix/delete");
        Route::post('/action',                          [$controller, 'action'])->name("$prefix/action");
        Route::get('/status=active',                    [$controller, 'showActive'])->name("$prefix/showActive");
        Route::get('/status=inactive',                  [$controller, 'showInactive'])->name("$prefix/showInactive");
        Route::get('/change-status-{status}/{id?}',     [$controller, 'status'])->name("$prefix/status")->where('id', '[0-9]+');
        Route::get('/change-type-{type}/{id?}',         [$controller, 'type'])->name("$prefix/type")->where('id', '[0-9]+');
        // Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    //======= MEDIA ========
    $prefix         = 'media';
    $controller = MediaController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {

        Route::get('/',                                 [$controller, 'index'])->name($prefix);
    });
    //===== SETTING ======
    $prefix     = 'setting';
    $controller = SettingController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {
        Route::get('/',                                     [$controller, 'index'])->name($prefix);
        Route::get('/edit/{config_key?}',                   [$controller, 'edit'])->name("$prefix/edit");
        Route::post('/update/{config_key?}',                [$controller, 'update'])->name("$prefix/update");
    });
    //======= ORDER ========
    $prefix         = 'order';
    $controller = OrderController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {

        Route::get('/',                                 [$controller, 'index'])->name($prefix);
        Route::get('/detail/{id?}',                                 [$controller, 'orderDetail'])->name("$prefix/detail");
        Route::get('/change-status-{status}/{id?}',     [$controller, 'status'])->name("$prefix/status")->where('id', '[0-9]+');
    });
});


//!=================================================== FRONTEND =======================================================
$prefixHome = config('zvn.url.prefix_frontend');
Route::group(['prefix' => $prefixHome,'namespace' => 'Frontend',], function () use ($prefixHome) {
    //===== HOMEPAGE ======
    $prefix     = '';
    $controller = HomeController::class;
    Route::group(['prefix' => $prefix], function () use ($controller) {
        Route::get('/',                                 [$controller, 'index'])->name("home");
    });
    //======= LOGIN ========
    $prefix     = '';
    $controller = AuthController::class;
    Route::group(['prefix' => $prefix], function () use ($controller) {


        Route::get('/login',                            [$controller, 'login'])->middleware('login')->name("login");
        Route::post('/checklogin',                      [$controller, 'checklogin'])->name("checklogin");
        //======= LOGOUT ========
        Route::get('/logout',                           [$controller, 'logout'])->name("logout");
    });

    //======= NOTIFY ========
    $prefix     = '';
    $controller = NotifyController::class;
    Route::group(['prefix' => $prefix], function () use ($controller) {
        Route::get('/no-permission',                    [$controller, 'noPermission'])->name("noPermission");
        Route::get('/no-login',                    [$controller, 'noLogin'])->name("noLogin");
    });

    //===== POST ======
    $prefix     = 'tin-tuc';
    $controller = FrontendPostController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {
        Route::get('/',                                 [$controller, 'index'])->name($prefix);
    });

    //===== SHOP ======
    $prefix     = 'san-pham';
    $controller = ShopController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {
        Route::get('/',                                 [$controller, 'index'])->name($prefix);
        Route::get('/{product_name}/{product_id?}.html',[$controller, 'detail_product'])->name("$prefix/index")->where('id', '[0-9]+');
        Route::get('/danh-muc={category_name}/{id?}',    [$controller, 'getProductCate'])->name("$prefix/danh-muc");
    });


    //===== CART ======
    $prefix     = 'gio-hang';
    $controller = CartController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {
        Route::get('/',                                 [$controller, 'index'])->name($prefix);
        Route::get('/add-to-cart/{id?}',                                 [$controller, 'add'])->name("$prefix/add");
        Route::get('/update-cart/{id?}',                                 [$controller, 'update'])->name("$prefix/update");
        Route::get('/delete/{id?}',                                 [$controller, 'delete'])->name("$prefix/delete");
        Route::get('/clear',                                 [$controller, 'clear'])->name("$prefix/clear");
    });

    //===== CHECKOUT ======
    $prefix     = 'dat-hang';
    $controller = CheckoutController::class;
    Route::group(['prefix' => $prefix,'middleware'=>['check.login']], function () use ($prefix, $controller) {
        Route::get('/',                                 [$controller, 'index'])->name($prefix);
        Route::post('/save',                                 [$controller, 'save'])->name("$prefix/save");
        Route::get('/cam-on',                                 [$controller, 'thankyou'])->name("$prefix/thankyou");
        Route::get('/don-hang',                                 [$controller, 'order'])->name("$prefix/order");
        Route::get('/chi-tiet-don-hang/{id?}',                                 [$controller, 'orderDetail'])->name("$prefix/orderDetail");
    });
});
