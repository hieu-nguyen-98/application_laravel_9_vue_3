<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TablePriceController;
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

Route::get('/',[HomeController::class, 'index']);
Route::get('/product',[ProductController::class, 'home']);
Route::get('/product/{id}',[ProductController::class, 'showOrder']);
Route::get('/api/getProducts',[HomeController::class, 'getProducts']);
Route::get('/api/detailProduct/{id}',[HomeController::class, 'detailProduct']);
Route::get('/api/getSettings ',[HomeController::class, 'getSettings']);
Route::post('/api/createOrder ',[HomeController::class, 'createOrder']);

Route::get('/table-price ',[TablePriceController::class, 'index']);
Route::get('/story',[StoryController::class, 'index']);
Route::get('/story/{id}',[StoryController::class, 'show']);
Route::get('/api/getBlogs',[StoryController::class, 'getBlogs']);
Route::get('/api/getBlogLatest',[StoryController::class, 'getBlogLatest']);
Route::get('/api/getBlogView',[StoryController::class, 'getBlogView']);
Route::get('/api/detailBlog/{id}',[StoryController::class, 'detailBlog']);
// Route::get('/product',[HomeController::class, 'product']);
// Route::get('/categories',[HomeController::class, 'categories']);
// Route::get('/admin/categories',[DashboardController::class, 'categories']);

Route::middleware(['auth', 'admin'])->group(function () {
    // Start Dashboard
    Route::get('/admin/dashboard',[DashboardController::class, 'index']);
    Route::get('/api/stats/appointments', [DashboardController::class, 'appointments']);
    Route::get('/api/stats/users', [DashboardController::class, 'users']);
    // End Dashbaord
    // Start User
    Route::get('/admin/users',[UserController::class, 'index']);
    Route::get('/api/users', [UserController::class, 'getUser']);
    Route::post('/api/users', [UserController::class, 'store']);
    Route::put('/api/users/{id}', [UserController::class, 'update']);
    Route::delete('/api/users/{id}', [UserController::class, 'destory']);
    Route::patch('/api/users/{id}/change-role', [UserController::class, 'changeRole']);
    Route::delete('/api/users', [UserController::class, 'MultipleDelete']);
    // End User
    // Start Appoinment
    Route::get('/admin/appointments',[AppointmentController::class, 'index']);
    Route::get('/api/appointments', [AppointmentController::class, 'getAppointment']);
    Route::get('/api/appointment-status', [AppointmentController::class, 'getStatusWithCount']);
    Route::get('/admin/appointments/create',[AppointmentController::class, 'create']);
    Route::post('/api/appointments/create', [AppointmentController::class, 'store']);
    Route::get('/admin/appointments/{id}/edit',[AppointmentController::class, 'edit']);
    Route::get('/api/appointments/{appointment}/edit', [AppointmentController::class, 'editData']);
    Route::put('/api/appointments/{id}/edit', [AppointmentController::class, 'update']);
    Route::delete('/api/appointments/{id}', [AppointmentController::class, 'destroy']);
    // End Appoinment
    // Start Client
    Route::get('/api/clients', [ClientController::class, 'index']);
    // End Client
    // Start Setiings
    Route::get('/admin/settings', [SettingController::class, 'index']);
    Route::get('/api/settings', [SettingController::class, 'settings']);
    Route::post('/api/settings/{id}', [SettingController::class, 'update']);
    // End Setiings
    // Start Profile
    Route::get('/admin/profiles', [ProfileController::class, 'index']);
    Route::get('/api/profile', [ProfileController::class, 'getProfile']);
    Route::put('/api/profile/{id}', [ProfileController::class, 'update']);
    Route::post('/api/change-user-password/{id}', [ProfileController::class, 'changePassword']);
    Route::post('/api/upload-profile-image', [ProfileController::class, 'uploadImage']);
    // End Profile
    // Start Product
    Route::get('/admin/products',[ProductController::class, 'index']);
    Route::get('/api/products', [ProductController::class, 'getProducts']);
    Route::get('/admin/products/create',[ProductController::class, 'create']);
    Route::post('/api/products/create',[ProductController::class, 'store']);
    Route::get('/admin/products/{id}/edit',[ProductController::class, 'edit']);
    Route::get('/api/products/{product}/edit',[ProductController::class, 'editData']);
    Route::post('/api/products/{id}/edit', [ProductController::class, 'update']);
    Route::delete('/api/products/{id}', [ProductController::class, 'destroy']);
    Route::delete('/api/products', [ProductController::class, 'MultipleDelete']);
    // End Product
    // Start Blog
    Route::get('/admin/blogs',[BlogController::class, 'index']);
    Route::get('/api/blogs',[BlogController::class, 'getBlogs']);
    Route::get('/admin/blogs/create',[BlogController::class, 'create']);
    Route::post('/api/blogs/create',[BlogController::class, 'store']);
    Route::get('/admin/blogs/{id}/edit',[BlogController::class, 'edit']);
    Route::get('/api/blogs/{blog}/edit',[BlogController::class, 'editData']);
    Route::post('/api/blogs/{id}/edit', [BlogController::class, 'update']);
    Route::delete('/api/blogs/{id}', [BlogController::class, 'destroy']);
    Route::delete('/api/blogs', [BlogController::class, 'MultipleDelete']);
    // End Blog
});
//Admin Dashboard
Route::get('admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/api/login', [LoginController::class, 'login']);
Route::get('admin/logout', [LoginController::class, 'logout']);
//Admin Dashboard
