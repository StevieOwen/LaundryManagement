<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\AuthController;
use App\Controller\EmployeeController;
use App\Controller\AdminController;;

Route::get('/', function () {
    return view('')->middleware('auth');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('user/login','login')->name('user.login');
    Route::post('user/login','handleLogin')->name('user.handleLogin');
    

});

Route::controller(EmployeeController::class)->group(function(){
    Route::get('employee/dashboard','dashboard')->name('employee.dashboard');
    Route::post('employee/update/user','editUser')->name('employee.update.user');
    Route::post('employee/delete/user','destroyUser')->name('employee.destroy_user');


});

Route::controller(AdminController::class)->group(function(){
    Route::get('admin/dashboard','dashboard')->name('admin.dashboard');
    Route::get('admin/users','users')->name('admin.users');
    Route::post('admin/store/user','storeUser')->name('admin.store_user');
    Route::post('admin/update/{user}/user','updateUser')->name('admin.update.user');
    Route::post('admin/delete/{user}/user','deleteUser')->name('admin.delete_user');

    Route::get('admin/categories','categories')->name('admin.categories');
    Route::post('admin/store/category','storeCategory')->name('admin.store_categories');
    Route::post('admin/update/{category}/category','updateCategory')->name('admin.update_category');
    Route::post('admin/delete/{category}','deleteCategory')->name('admin.delete_category');

    Route::get('admin/items','items')->name('admin.items');
    Route::post('admin/store/items','storeItems')->name('admin.store_items');
    Route::post('admin/update/{item}/items','updateItems')->name('admin.update_items');
    Route::post('admin/delete/{item}/items','deleteItems')->name('delete.items');

});