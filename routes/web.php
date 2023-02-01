<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\post\PostController;


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

Auth::routes();
Route::get('/signin',  [HomeController::class, 'signin'])->name('signin');



Route::get('/logout',  [HomeController::class, 'logout'])->name('logout');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    // CRUD Generator
    Route::get('crud-generator', [Hamdan\CrudGenerator\Controllers\ProcessController::class,'getGenerator'])->name('generator');
    Route::post('process', [Hamdan\CrudGenerator\Controllers\ProcessController::class,'postGenerator'])->name('postGenerator');



    // Config
    Route::get('/config/favicon', [ConfigController::class, 'favicon'])->name('admin.config.favicon');
    Route::get('/config/logo', [ConfigController::class, 'logo'])->name('admin.config.logo');
    Route::get('/config/settings', [ConfigController::class, 'configSettings'])->name('admin.config.settings');
    Route::post('/config/update', [ConfigController::class, 'configPost'])->name('admin.config.post');
    Route::get('/config/option', [ConfigController::class, 'configOption'])->name('admin.config.option');
    Route::post('/config/option/update', [ConfigController::class, 'configOptionUpdate'])->name('admin.config.option.update');

    // Banner
    Route::resource('banner', BannerController::class);

    // Category
    Route::resource('category', CategoryController::class);

    // Customer
    Route::resource('customer', CustomerController::class);
    require_once('crudweb.php');
});
Route::get('/', [UserController::class, 'index'])->name('user.dashboard');


Route::group(['prefix' => 'user', 'middleware' => 'isUser'], function () {

    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::get('/settings', [PostController::class, 'settings'])->name('user.settings');

    Route::resource('post', PostController::class);
    Route::get('/post-filter', [UserController::class,'filter'])->name('post.filter');


});
// Route::group(['prefix' => 'user', 'middleware'=>'isUser'], function(){
//     Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
//     Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
//     Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');

// });
// Route::get('admin', 'App\Http\Controllers\Admin\AdminController@index');
// Route::resource('admin/roles', 'App\Http\Controllers\Admin\RolesController');
// Route::resource('admin/permissions', 'App\Http\Controllers\Admin\PermissionsController');
// Route::resource('admin/users', 'App\Http\Controllers\Admin\UsersController');
// Route::resource('admin/pages', 'App\Http\Controllers\Admin\PagesController');
// Route::resource('admin/activitylogs', 'App\Http\Controllers\Admin\ActivityLogsController')->only([
//     'index', 'show', 'destroy'
// ]);
// Route::resource('admin/settings', 'App\Http\Controllers\Admin\SettingsController');
// Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
// Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);



