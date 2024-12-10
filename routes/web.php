<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\moderatorController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\sellerController;
use App\Http\Controllers\UserAuthController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

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
//customer routes
Route::get('/',[customerController::class,'home'])->name('home');
Route::get('/product/lists',[customerController::class,'productlists'])->name('productlists');
Route::get('/product/detail/{id}',[customerController::class,'productdetail'])->name('furnituredetail');
Route::get('/signup',[customerController::class,'signup'])->name('signup');
Route::get('/login/{customer?}',[customerController::class,'login'])->name('login');
Route::Post('/seller/register',[customerController::class,'sellerregistration'])->name('seller-register');
Route::Post('/login/auth',[UserAuthController::class,'auth'])->name('login-auth');
Route::get('/cart/add/{id}',[cartController::class,'addToCart'])->name('addtocart');
Route::get('/cart/view/{id}',[cartController::class,'showCart'])->name('cartview');
Route::get('/cart/remove/{id}',[cartController::class,'removeFromCart'])->name('cartremove');
Route::get('/create/order/{id?}',[orderController::class,'createorder'])->name('createorder');
Route::post('/post/order/{id?}',[orderController::class,'orderpost'])->name('postorder');
Route::get('/add/to/cart/{id}',[cartController::class,'addtocart'])->name('addtocart');
Route::get('/search',[customerController::class,'searchfurniture'])->name('search');
Route::get('/topayments/{totalcost}/{orderid}',[customerController::class,'topayments'])->name('topayments');
Route::get('/payments/{orderid}',[customerController::class,'orderpayments'])->name('payments');

Route::get('/download/image/{fid}',[sellerController::class,'downloadimage'])->name('downloadimage');

//customer
Route::group(['middleware'=>'customer'], function(){
    Route::get('/landing',[customerController::class,'customerlanding'])->name('customer');
    Route::get('/customer/logout',[customerController::class,'customerlogout'])->name('customerlogout');
    Route::get('/customer/dispute/{id}',[customerController::class,'dispute'])->name('dispute');
    Route::get('/post/feed/view/{id}',[customerController::class,'feedpostpage'])->name('feedpostpg');
    Route::post('/post/feedback/{id}',[customerController::class,'feedbackpost'])->name('feedbackpost');
    Route::get('/ordered/furniture/{id}',[customerController::class,'orderedfurniture'])->name('orderedfurniture');
  

});
//seller's routes
Route::group(['middleware'=>'seller'], function(){
Route::get('/seller',[sellerController::class,'sellerlanding'])->name('seller');
Route::get('/seller/logout',[sellerController::class,'sellerlogout'])->name('sellerlogout');
Route::get('/furniture/form/{id?}',[sellerController::class,'furnitureform'])->name('furnitureform');
Route::post('/furniture/post',[sellerController::class,'storefurniture'])->name('furniturepost');
Route::delete('/furniture/delete/{dele}',[sellerController::class,'furnituredelete'])->name('furnituredelete');
Route::post('/furniture/edit/{id}',[sellerController::class,'furnitureedit'])->name('furnitureedit');
Route::get('/orders',[orderController::class,'orderview'])->name('vieworders');
Route::get('/complete/orders/{id}',[sellerController::class,'ordercomplete'])->name('completeorder');
Route::get('/feedbacks',[feedbackController::class,'feedbackview'])->name('viewfeedbacks');
Route::get('/ordered/furniture/seller/{id}',[sellerController::class,'orderedfurniture'])->name('toorderedfurniture');
Route::delete('/ordered/delete/{id}',[sellerController::class,'deleteorder'])->name('orderdele');


});


//admin's routes
Route::group(['middleware'=>'admin'], function(){
    Route::get('/admin',[adminController::class,'adminlanding'])->name('admin');
    Route::get('/admin/logout',[adminController::class,'adminlogout'])->name('adminlogout');
    Route::get('/block/{id}',[adminController::class,'blockuser'])->name('blockuser');
    Route::get('/unblock/{id}',[adminController::class,'unblockuser'])->name('unblockuser');
    Route::get('/category/form/{id?}',[adminController::class,'categoryformview'])->name('catform');
    Route::get('/category/view',[adminController::class,'categoryview'])->name('catview');
    Route::post('/edit/{id}',[adminController::class,'catedit'])->name('catedit');
    Route::post('/category/post',[adminController::class,'categorypost'])->name('categorypost');
    Route::delete('/category/delete/{dele}',[adminController::class,'categorydelete'])->name('catdele');
    Route::get('/Add/Moderator/{id?}',[adminController::class,'moderatorformview'])->name('moderatorform');
    Route::post('/moderator/post',[adminController::class,'moderatorpost'])->name('modepost');
    Route::post('/moderator/edit/{id}',[adminController::class,'moderatoredit'])->name('modeedit');
    Route::get('/view/moderator/{id?}',[adminController::class,'moderatorview'])->name('modeview');
    Route::delete('/moderator/delete/{dele}',[adminController::class,'modedelete'])->name('modedele');


});

//moderator's routes
Route::group(['middleware'=>'moderator'], function(){
    Route::get('/moderator',[moderatorController::class,'moderatorlanding'])->name('moderator');
    Route::get('/moderator/logout',[moderatorController::class,'moderatorlogout'])->name('moderatorlogout');
    Route::get('/userblock',[moderatorController::class,'moderatoruserblock'])->name('blockusers');
    Route::get('/block/user/{id}',[moderatorController::class,'blockuser'])->name('blockusermode');
    Route::get('/unblock/user/{id}',[moderatorController::class,'unblockuser'])->name('unblockusermode');
    Route::get('/complete/dispute/{id}',[moderatorController::class,'completedispute'])->name('completedispute');
  
});
