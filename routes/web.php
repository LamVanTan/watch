<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Watch\IndexController;
use App\Http\Controllers\Watch\ProductsController;
use App\Http\Controllers\Watch\ContactController;
use App\Http\Controllers\Watch\AboutController;
use App\Http\Controllers\Watch\CartController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Watch\PayPalController;
//admin
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\Admin\AdminSaleController;
use App\Http\Controllers\Admin\AdminCheckoutController;
use App\Http\Controllers\Admin\AdminUserController;

// Route::get('pass', function () {
//     return bcrypt(123123);
// });
// Route::get('/envato-user-helper-demo', function () {
//     return EnvatoHelpers::get_username(2);
// });
// 
//Route::post('payment',[PaymentController::class,'payment'])->name('watch.watch.payment');
Route::pattern('slug','(.*)');
Route::pattern('id','([0-9]*)');

// Route::prefix('/public')->middleware('auth')->group(function(){
Route::get('',[IndexController::class, 'index'])
->name('watch.index.index');

Route::post('/shopAll',[IndexController::class, 'shopAll'])
->name('watch.index.shopAll');

Route::get('/{slug}-{id}',[ProductsController::class, 'products'])
->name('watch.watch.products');

Route::get('/{slug}-{id}.html',[ProductsController::class, 'single'])
->name('watch.watch.single');

Route::get('/contact',[ContactController::class, 'contact'])
->name('watch.contact.contact');

Route::post('/contact',[ContactController::class, 'postcontact'])
->name('watch.contact.contact');

Route::get('/about',[AboutController::class, 'about'])
->name('watch.about.about');

Route::get('/cart',[CartController::class, 'cart'])
->name('watch.watch.cart');

Route::post('/cart',[CartController::class, 'addCart'])
->name('watch.watch.add-cart');

Route::post('/remove',[CartController::class, 'removeCart'])
->name('watch.watch.remove-ajax');

Route::post('/changeQty',[CartController::class, 'changeQty'])
->name('watch.watch.changeQty-ajax');

Route::get('/checkout',[ProductsController::class, 'checkout'])
->name('watch.watch.checkout')->middleware('auth');

Route::get('/purchase_menu',[ProductsController::class, 'purchase_menu'])
->name('watch.watch.purchase_menu')->middleware('auth');

Route::post('/purchase_menu',[ProductsController::class, 'checkoutCustomer'])
->name('ajax-status-checkoutCustomer')->middleware('auth');

Route::get('/status',[ProductsController::class, 'status'])
->name('ajax-status-time')->middleware('auth');


Route::post('/checkout',[ProductsController::class, 'postcheckout'])
->name('watch.watch.checkout');

//payment vnpay
Route::post('/payment',[ProductsController::class, 'payment'])
->name('watch.checkout.payment');
//payment vnpay
Route::get('/payment',[ProductsController::class, 'getpayment'])
->name('payment-vnpay');


Route::post('/discount',[ProductsController::class, 'discount'])
->name('watch.watch.discount');

Route::post('/search',[ProductsController::class, 'search'])
->name('watch.watch.search');



Route::prefix('/auth')->group(function(){
//public 
	Route::get('/login',[AuthController::class, 'login'])
	->name('watch.auth.login');

	Route::post('/login',[AuthController::class, 'postLogin'])
	->name('watch.auth.login');

	Route::post('/Forgot_password',[AuthController::class, 'Forgot_password'])
	->name('watch.auth.Forgot_password');

	 Route::get('/register',[AuthController::class, 'register'])
	 ->name('watch.auth.register');

	Route::post('/register',[AuthController::class, 'postRegister'])
	->name('watch.auth.register');	
	Route::get('/logout', [AuthController::class, 'logout'])->name('watch.auth.logout');



	//admin
	Route::get('/loginAdmin', [AuthController::class, 'loginAdmin'])->name('auth.auth.login');
	Route::post('/loginAdmin', [AuthController::class, 'postloginAdmin'])->name('auth.auth.login');

	Route::get('/logoutAdmin', [AuthController::class, 'logoutAdmin'])->name('auth.auth.logout');
});



//admin
Route::prefix('/admin')->middleware('role')->group(function(){

	Route::get('', [AdminIndexController::class, 'index'])->name('admin.index.index');

	// quan li danh mục
	Route::prefix('/category')->group(function(){
		Route::get('/index', [AdminCategoryController::class, 'index'])->name('admin.category.index');
		Route::get('/add', [AdminCategoryController::class, 'add'])->name('admin.category.add');
		Route::post('/add', [AdminCategoryController::class, 'postadd'])->name('admin.category.add');
		Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
		Route::post('/edit/{id}', [AdminCategoryController::class, 'postedit'])->name('admin.category.edit');	
		Route::get('/delete/{id}', [AdminCategoryController::class, 'del'])->name('admin.category.delete');
		Route::post('/ajax-status-post', [AdminCategoryController::class, 'ajax_status_post'])->name('ajax-status-post');
	});

	//quan chiết khấu giảm giá
	Route::prefix('/sale')->group(function(){
		Route::get('/index', [AdminSaleController::class, 'index'])->name('admin.sale.index');
		Route::get('/add', [AdminSaleController::class, 'add'])->name('admin.sale.add');
		Route::post('/add', [AdminSaleController::class, 'postadd'])->name('admin.sale.add');
		Route::get('/edit/{sale_id}', [AdminSaleController::class, 'edit'])->name('admin.sale.edit');
		Route::post('/edit/{sale_id}', [AdminSaleController::class, 'postedit'])->name('admin.sale.edit');
		Route::get('/delete/{sale_id}', [AdminSaleController::class, 'delete'])->name('admin.sale.delete');
		
	});

	//SAN PHAM
	Route::prefix('/products')->group(function(){
		Route::get('/index',[AdminProductsController::class, 'index'])->name('admin.products.index');
		Route::get('/add', [AdminProductsController::class, 'add'])->name('admin.products.add');
		Route::post('/add', [AdminProductsController::class, 'postadd'])->name('admin.products.add');
		Route::get('/edit/{id}', [AdminProductsController::class, 'edit'])->name('admin.products.edit');
		Route::post('/edit/{id}', [AdminProductsController::class, 'postedit'])->name('admin.products.edit');	
		Route::get('/delete/{id}', [AdminProductsController::class, 'delete'])->name('admin.products.delete');
		Route::post('/ajax-status-products', [AdminProductsController::class, 'ajax_status_products'])->name('ajax-status-products');

		Route::post('/editpicture/{idPic}', [AdminProductsController::class, 'editpicture'])->name('admin.products.editpicture');
		Route::get('/deletepicture/{idPic}', [AdminProductsController::class, 'deletepicture'])->name('admin.products.deletepicture');
	});


	//quan ly user
	Route::prefix('/user')->middleware('check')->group(function(){
		Route::get('/index',[AdminUserController::class, 'index'])->name('admin.users.index');
		Route::get('/add',[AdminUserController::class, 'add'])->name('admin.users.add');
		Route::post('/add' , [AdminUserController::class, 'postadd'])->name('admin.users.add');
		Route::get('/edit/{id}',[AdminUserController::class, 'edit'])->name('admin.users.edit');
		Route::post('/edit/{id}',[AdminUserController::class, 'postedit'])->name('admin.users.edit');
		Route::get('/delete/{id}',[AdminUserController::class, 'delete'])->name('admin.users.delete');		
	});
	
	
	Route::prefix('/checkout')->group(function(){
		Route::get('/index', [AdminCheckoutController::class, 'index'])->name('admin.checkout.index');
		Route::post('ajax-checkout', [AdminCheckoutController::class, 'ajaxcheckout'])->name('ajax-status-checkout');	

		Route::get('/status-checkout',[AdminCheckoutController::class, 'status'])->name('ajax-status');
	});
	



	


});