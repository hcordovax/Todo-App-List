<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/save_new_todolist', 'TodoListController@store');
Route::get('/tasks/{list_id}', 'TodoListController@show');
Route::post('/tasks/{list_id}/new_task', 'TodoListController@addtask');
Route::post('/tasks/{list_id}/mark_as_done', 'TodoListController@markTaskAsDone');

Route::get('/tasks/delete/{list_id}', 'TodoListController@destroy');

Route::get('/tasks/delete/subtasks/{list_id}', 'TodoListController@removesubtask');

Route::put('/tasks/edit/todo/{id}', 'TodoListController@edittodo');

Route::put('/tasks/edit/subtask/{id}', 'TodoListController@editsubtask');

