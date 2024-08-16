<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookLogController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\MemberAreaController;
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

Route::post('/webhook', [LicenseController::class, 'handleWebhook']);
Route::get('/webhook', [LicenseController::class, 'handleWebhook']);
Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
	// Route::get('dashboard', function () {
	// 	return view('dashboard');
	// })->name('dashboard');
	Route::get('planos/{productName?}', [OfferController::class, 'plans'])->name('planos');

	Route::get('/vitrine', [MemberAreaController::class, 'index'])->name('vitrine');
	Route::get('/vitrine/{id}', [MemberAreaController::class, 'select'])->name('vitrine.select');
	Route::get('/conteudo/{id}', [MemberAreaController::class, 'find'])->name('content.find');
	Route::patch('/content/{id}/status', [ContentController::class, 'updateStatus'])->name('content.updateStatus');
	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('home', function () {
		return view('home');
	})->name('home');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/perfil', [InfoUserController::class, 'create']);
	Route::put('/user-profile', [InfoUserController::class, 'update'])->name('user-profile.update');
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
	Route::get('/produto/{id}', [ProductController::class, 'find'])->name('products.find');
	Route::put('/produto/{id}', [ProductController::class, 'update'])->name('products.update');
	Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');
	Route::get('/criar/produtos', [ProductController::class, 'create'])->name('products.create');
	Route::post('/produtos', [ProductController::class, 'store'])->name('products.store');
	Route::delete('/produtos/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
	Route::get('/products/move-up/{id}', [ProductController::class, 'moveUp'])->name('products.moveUp');
	Route::get('/products/move-down/{id}', [ProductController::class, 'moveDown'])->name('products.moveDown');

	Route::get('/criar/conteudo', [ContentController::class, 'create'])->name('content.create');
	Route::post('/conteudo', [ContentController::class, 'store'])->name('content.store');
	Route::put('/conteudo/{id}', [ContentController::class, 'update'])->name('content.update');
	Route::get('/editarConteudo/{id}', [ContentController::class, 'find'])->name('content.edit');
	Route::delete('/conteudo/{id}', [ContentController::class, 'destroy'])->name('content.destroy');
	Route::get('/conteudo/move-up/{id}', [ContentController::class, 'moveUp'])->name('content.moveUp');
	Route::get('/conteudo/move-down/{id}', [ContentController::class, 'moveDown'])->name('content.moveDown');

	Route::get('/oferta/{id}', [OfferController::class, 'find'])->name('offers.find');
	Route::put('/oferta/{id}', [OfferController::class, 'update'])->name('offers.update');
	Route::get('/ofertas', [OfferController::class, 'index'])->name('offers.index');
	Route::get('/criar/ofertas', [OfferController::class, 'create'])->name('offers.create');
	Route::post('/ofertas', [OfferController::class, 'store'])->name('offers.store');
	Route::delete('/ofertas/{id}', [OfferController::class, 'destroy'])->name('offers.destroy');
	// Route::resource('licenses', LicenseController::class);
	// Route::post('licenses/search', [LicenseController::class, 'search'])->name('licenses.search');
	Route::post('/licenses/search', [LicenseController::class, 'search'])->name('licenses.search');
	Route::get('licenses', [LicenseController::class, 'index'])->name('licenses.index');
	Route::put('license/{id}', [LicenseController::class, 'edit'])->name('licenses.edit');
	Route::put('license/{id}', [LicenseController::class, 'update'])->name('licenses.update');
	Route::get('license/{id}', [LicenseController::class, 'edit'])->name('licenses.edit');
	Route::delete('license/{id}', [LicenseController::class, 'destroy'])->name('licenses.destroy');
	Route::resource('logs', WebhookLogController::class);

	Route::get('dominios', [DomainController::class, 'index'])->name('domains.index');
	Route::post('dominio', [DomainController::class, 'store'])->name('domains.store');
	Route::delete('dominio/{id}', [DomainController::class, 'destroy'])->name('domains.destroy');
	Route::put('dominio/{id}', [DomainController::class, 'edit'])->name('domains.edit');
	Route::get('users', [UserController::class, 'index'])->name('users.index');
	Route::get('users/create', [UserController::class, 'create'])->name('users.create');
	Route::post('users', [UserController::class, 'store'])->name('users.store');
	Route::get('users/{id}', [UserController::class, 'edit'])->name('users.edit');
	Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
	Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
Route::post('api/authenticate', [MobileController::class, 'authenticate']);
Route::get('api/products', [MobileController::class, 'getProductsWithContents']);
Route::get('/{license_key}', [LicenseController::class, 'checkStatus']);
