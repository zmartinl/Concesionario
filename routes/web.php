<?php

/**
 * Routes file for managing the application routes.
 * 
 * @category Routes
 * @package  App\Http\Controllers
 * @author   Zeus <zmartinllera1@gmail.com>
 * @license  MIT License
 * @link     No domain specified
 */

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoricController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// GET

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::get('/adminPanel', [AdminController::class, 'index'])
    ->name('adminPanel');

Route::get('/createTask', [AdminController::class, 'create'])
    ->name('createTask');

Route::get('/editTask', [AdminController::class, 'menuEdit'])
    ->name('menuEditTask');

Route::get('/menuEditTask', [AdminController::class, 'editTask'])
    ->name('editTask');

Route::get(
    '/editTask/{id}', function ($id) {
        return AdminController::editTask($id);
    }
)->name('editingTask');
    

Route::get('/userPanel', [UserController::class, 'getTasks'])
    ->name('userPanel');

Route::get('/historic', [HistoricController::class, 'index'])
    ->name('historic');

Route::get(
    '/deletedTask/{id}', function ($id) {
        return AdminController::deletingTask($id);
    }
)->name('deletingTask');

// POST

Route::post('/createTask', [AdminController::class, 'createTask'])
    ->name('taskCreated');

Route::post('/editTask', [AdminController::class, 'taskEdited'])
    ->name('taskEdited');

Route::post('/completeTask/{id}', [UserController::class, 'completeTask'])
    ->name('completeTask');

Route::post('/startTask/{id}', [UserController::class, 'startTask'])
    ->name('startTask');
