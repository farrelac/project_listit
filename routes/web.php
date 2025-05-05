<?php

use App\Http\Controllers\Halo\HaloController;
use App\Http\Controllers\ToDo\ToDoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Membuat routing baru
// Route::get('/halo', function(){
//     return view('coba.halo'); //'coba' didapat dari folder baru .nama file blade nya
// });

Route::get('/halo', [HaloController::class, 'coba']);

// Route::get('todo', function(){
//     return view('ToDo.app');
// });

Route::get('/todo', [ToDoController::class, 'index']) -> name('todo');
Route::post('/todo', [ToDoController::class, 'store']) -> name('todo.post');
Route::put('/todo/{id}', [ToDoController::class, 'update']) -> name(('todo.update'));
Route::delete('/todo/{id}', [ToDoController::class, 'destroy']) -> name(('todo.delete'));