<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\api\RecompensaController;
use App\Http\Controllers\api\CategoriaController;
use App\Http\Controllers\api\PedidoController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\UsuarioController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;
use PHPUnit\Framework\Attributes\Ticket;

Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget.password.post');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');

//Api Tareas
Route::get('tasks', [TaskController::class, 'index']);
Route::post('tasks/', [TaskController::class, 'store']);
Route::put('tasks/update/{id}', [TaskController::class, 'update']);
Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
Route::get('tasks/{id}', [TaskController::class, 'edit']);

//Api Recompensas
Route::get('recompensas', [RecompensaController::class, 'index']);
Route::post('recompensas/', [RecompensaController::class, 'store']);
Route::put('recompensas/update/{id}', [RecompensaController::class, 'update']);
Route::delete('recompensas/{id}', [RecompensaController::class, 'destroy']);

//Api Categorias
Route::get('categorias', [CategoriaController::class, 'index']);
Route::post('categorias/', [CategoriaController::class, 'store']);
Route::put('categorias/update/{id}', [CategoriaController::class, 'update']);
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);

// //Api Pedidos
// Route::get('pedidos', [PedidoController::class, 'index']);
// Route::post('pedidos/', [PedidoController::class, 'store']);
// Route::put('pedidos/update/{id}', [PedidoController::class, 'update']);
// Route::delete('pedidos/{id}', [PedidoController::class, 'destroy']);

// //Api Usuarios
Route::get('usuarios', [UsuarioController::class, 'index']);
Route::post('usuarios/', [UsuarioController::class, 'store']);
Route::put('usuarios/update/{id}', [UsuarioController::class, 'update']);
Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy']);

// //Api Niveles
// Route::get('niveles', [NivelController::class, 'index']);
// Route::post('niveles/', [NivelController::class, 'store']);
// Route::put('niveles/update/{id}', [NivelController::class, 'update']);
// Route::delete('niveles/{id}', [NivelController::class, 'destroy']);






Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('users', UserController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);
    //Route::apiResource('exercises', ExerciseController::class);
    Route::post('exercises/', [ExerciseController::class,'store']); //Guardar
    Route::get('exercises', [ExerciseController::class,'index']); //Listar
    Route::get('exercises/{exercise}', [ExerciseController::class,'show']); //Mostrar
    Route::post('exercises/update/{id}', [ExerciseController::class,'update']); //Editar

    Route::get('role-list', [RoleController::class, 'getList']);
    Route::get('role-permissions/{id}', [PermissionController::class, 'getRolePermissions']);
    Route::put('/role-permissions', [PermissionController::class, 'updateRolePermissions']);
    Route::apiResource('permissions', PermissionController::class);
    Route::get('category-list', [CategoryController::class, 'getList']);
    Route::get('/user', [ProfileController::class, 'user']);
    Route::put('/user', [ProfileController::class, 'update']);

    Route::get('abilities', function(Request $request) {
        return $request->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});


Route::get('category-list', [CategoryController::class, 'getList']);
Route::get('get-posts', [PostController::class, 'getPosts']);
Route::get('get-category-posts/{id}', [PostController::class, 'getCategoryByPosts']);
Route::get('get-post/{id}', [PostController::class, 'getPost']);
