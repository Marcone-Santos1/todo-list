<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/todo-form', [TodoController::class, 'todoForm']);
Route::get('/todo-form-update/{id}', [TodoController::class, 'todoFormUpdate']);

Route::get('/', [TodoController::class, 'index']);
Route::get('/{id}', [TodoController::class, 'show']);

Route::post('/create', [TodoController::class, 'store']);

Route::put('/update/{id}', [TodoController::class, 'update']);
Route::put('/done/{id}', [TodoController::class, 'done']);
Route::delete('/delete/{id}', [TodoController::class, 'delete']);

