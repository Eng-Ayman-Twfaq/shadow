<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;

// الصفحة الرئيسية
// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// عرض تفاصيل المنتج
Route::get('/product/{id}', [HomeController::class, 'showProduct'])->name('product.show');

// حفظ طلب اتصال
Route::post('/contact-request', [HomeController::class, 'storeContactRequest'])->name('contact.request.store');


// مسار عرض صفحة تسجيل الدخول (GET فقط)
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

// مسار معالجة تسجيل الدخول (POST فقط)
Route::post('/admin/login', [LoginController::class, 'login'])
    ->name('admin.login.submit');

// مسار تسجيل الخروج
Route::post('/admin/logout', [LoginController::class, 'logout'])
    ->name('admin.logout')
    ->middleware('auth:admin');

// المسارات المحمية
Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
            
        // إدارة المنتجات
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
         
        
        // إدارة طلبات التواصل
        Route::resource('contact-requests', \App\Http\Controllers\Admin\ContactRequestsController::class)
            ->only(['index', 'show', 'update' , 'edit','destroy']);
        Route::get('/admin/contact-requests/{contact_request}', [ContactRequestController::class, 'show'])
    ->name('admin.contact-requests.show');
        // إدارة المستخدمين الإداريين
        Route::resource('admin-users', \App\Http\Controllers\Admin\AdminUsersController::class);
    });