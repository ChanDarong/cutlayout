<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    // return view('layouts.index');
    return redirect()->route('dashboard');
    // return view('auth.login');
})->middleware('auth');

Auth::routes();

// Route::get('/login', function(){
//     return view('auth.auth-login');
// })->name('login');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index']);
// Route::get('/profile', function(){
//     return view('profile');
// });

Route::get('/profile/edit', [ProfileController::class, 'edit']);
// Route::get('/profile/edit', function(){
//     return view('profile.edit');
// });
Route::put('/profile/update', [ProfileController::class, 'update']);
Route::get('/changepassword', [ProfileController::class, 'formpassword']);
Route::put('/changepassword/change', [ProfileController::class, 'changepassword']);

Route::get('/todolist', [TodoController::class, 'index'])->name('todo.index');
Route::post('/todolist/filter', [TodoController::class, 'filter']);
Route::get('/todolist/create', [TodoController::class, 'create'])->name('todo.create');
Route::post('/todolist/create', [TodoController::class, 'store'])->name('todo.store');
Route::get('/todolist/{todo}/view', [TodoController::class, 'show'])->name('todo.view');
Route::get('/todolist/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');
Route::put('/todolist/{todo}', [TodoController::class, 'update'])->name('todo.update');
Route::get('/todolist/{todo}/delete', [TodoController::class, 'destroy'])->name('todo.delete');
Route::get('/todolist/trash', [TodoController::class, 'trash'])->name('todo.trash');
Route::get('/todolist/{todo}/restore', [TodoController::class, 'restore']);
Route::get('/todolist/{todo}/forcedelete', [TodoController::class, 'forceDelete']);
Route::post('/todolist/trash/filter', [TodoController::class, 'filterTrash']);
Route::put('/todolist/{todo}/complete', [TodoController::class, 'complete']);
