<?php

declare(strict_types=1);

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    'auth',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('category/export/', [\App\Http\Controllers\CategoryController::class, 'export']);
    Route::get('product/export/', [\App\Http\Controllers\ProductController::class, 'export']);
    Route::get('loyalty/export/', [\App\Http\Controllers\LoyaltyController::class, 'export']);
    Route::get('inventory/export/', [\App\Http\Controllers\InventoryController::class, 'export']);
    Route::get('accountant/export/', [\App\Http\Controllers\AccountantController::class, 'export']);
    Route::get('productsReport/export/', [\App\Http\Controllers\ReportsController::class, 'exportSale']);
    Route::get('SalesReport/export/', [\App\Http\Controllers\ReportsController::class, 'exportInvoice']);



    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    Route::resource('inventory', \App\Http\Controllers\InventoryController::class);
    Route::resource('accountant', \App\Http\Controllers\AccountantController::class);

    Route::resource('settings', \App\Http\Controllers\SettingController::class);

    Route::get('pos', [\App\Http\Controllers\PosController::class,'index']);
    Route::post('invoice', [\App\Http\Controllers\PosController::class,'invoice'])->name("invoice");
    Route::get('returns', [\App\Http\Controllers\PosController::class,'returns']);
    Route::post('pos/create', [\App\Http\Controllers\PosController::class,'store'])->name("pos.store");
    Route::post('returns', [\App\Http\Controllers\PosController::class,'returns']);

    Route::get('productsReport', [\App\Http\Controllers\ReportsController::class,'productsReport']);
    Route::get('SalesReport', [\App\Http\Controllers\ReportsController::class,'salesReport']);
    Route::get('sync_role', [\App\Http\Controllers\POSController::class,'perm']);
    Route::post('productsReport', [\App\Http\Controllers\ReportsController::class,'updateProducts']);

    Route::resource("category", \App\Http\Controllers\CategoryController::class,);

    Route::resource("product", \App\Http\Controllers\ProductController::class,);

    Route::resource("loyalty", \App\Http\Controllers\LoyaltyController::class,);


});

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Auth::routes();
//    Route::get('/', function () {
//        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
//    });

    Route::get('/userss', function () {
        dd(\App\Models\User::all());
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

    Route::get('showInvoice/{id}', [\App\Http\Controllers\PosController::class,'showInvcoice']);
//    Route::get('/',function (){
//        return view('home');
//    } );

    //Update User Details
    Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

    Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
});
