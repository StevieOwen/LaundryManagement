<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\AuthController;
use App\Controller\EmployeeController;
use App\Controller\AdminController;;

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();

        return match ($user->role) {
            'admin'                           => redirect()->route('admin.dashboard'),
            'employee'                         => redirect()->route('employee.dashboard'),
            default                           => redirect()->route('employee.dashboard'),
        };
    }

    return redirect()->route('login');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('user/login','login')->name('login');
    Route::post('user/login','handleLogin')->name('user.handleLogin');
    

});

Route::controller(EmployeeController::class)->group(function(){
    Route::get('employee/dashboard','dashboard')->name('employee.dashboard');
    Route::patch('employee/update/user','editUser')->name('employee.update.user');
    Route::delete('employee/delete/user','destroyUser')->name('employee.destroy_user');

    Route::get('employee/orders','showOrders')->name('employee.orders');
    Route::get('employee/create/orders','createOrders')->name('employee.createOrders');
    Route::post('employee/orders/store','storeOrders')->name('employee.storeOrders');
    Route::patch('employee/{order}/update','updateOrder')->name('employee.update_order');
    Route::delete('employee/{order}/delete','deleteOrder')->name('employee.delete_order');


});

Route::controller(AdminController::class)->group(function(){
    Route::get('admin/dashboard','dashboard')->name('admin.dashboard');
    Route::get('admin/users','users')->name('admin.users');
    Route::post('admin/store/user','storeUser')->name('admin.store_user');
    Route::patch('admin/update/{user}/user','updateUser')->name('admin.update.user');
    Route::delete('admin/delete/{user}/user','deleteUser')->name('admin.delete_user');

    Route::get('admin/categories','categories')->name('admin.categories');
    Route::post('admin/store/category','storeCategory')->name('admin.store_categories');
    Route::patch('admin/update/{category}/category','updateCategory')->name('admin.update_category');
    Route::delete('admin/delete/{category}','deleteCategory')->name('admin.delete_category');

    Route::get('admin/items','items')->name('admin.items');
    Route::post('admin/store/items','storeItems')->name('admin.store_items');
    Route::patch('admin/update/{item}/items','updateItems')->name('admin.update_items');
    Route::delete('admin/delete/{item}/items','deleteItems')->name('delete.items');

});