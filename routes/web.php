<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PresentacioneController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('panel')->middleware('auth');

Route::get('/analiticas', function() {
    $results = DB::table('ventas')->get();
    return $results;
});

Route::middleware('auth')->group(function() {
    Route::resources([
        'categorias'        => CategoriaController::class,
        'marcas'            => MarcaController::class,
        'presentaciones'    => PresentacioneController::class,
        'productos'         => ProductoController::class,
        'clientes'          => ClienteController::class,
        'compras'           => CompraController::class,
        'proveedores'       => ProveedoresController::class,
        'ventas'            => VentaController::class,
        'users'             => UserController::class,
        'roles'             => RoleController::class,
        'profile'           => ProfileController::class
    ]);
});

Route::get('login', [LoginController::class, 'index'])->name('auth.loginForm');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');
Route::get('logout', [LogoutController::class, 'logout'])->name('auth.logout');