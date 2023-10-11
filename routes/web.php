<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        if (Auth::check()) {
            return view('index'); 
        } else {
            // User is not authenticated, redirect to the login page
            return redirect('/login');
        }
    });

    //CREATE
    Route::get('/create_task', function () {
        return view('create_task');
    });


    Route::post('/create_task', [TaskController::class, 'store']);



    //READ
    Route::get('/index', function () {
        return view('index');
    });

    Route::get('/task_detail/{id}', function () {
        return view('task_detail');
    });


    Route::get('/index', [TaskController::class, 'show']);

    Route::get('/log', [TaskController::class, 'taskLog']);

    Route::get('/task_analytics', [SubtaskController::class, 'taskAnalytics']);

    Route::get('/task_detail/{id}', [TaskController::class, 'showTaskDetails'])->name('task_detail');
    


    //UPDATE
    Route::get('/task_edit', function () {
        return view('task_edit');
    });

    Route::get('/task_edit/{task}', [TaskController::class, 'edit'])->name('task_edit');

    Route::put('/task_detail/{task}', [TaskController::class, 'update'])->name('task_update');

    Route::post('/task_detail/{id}/update-subtasks', [TaskController::class, 'updateSubtasks'])->name('task.update-subtasks');
    


    //DELETE
    Route::get('/deactivate_task/{id}', [TaskController::class, 'deactivateTask'])->name('deactivate_task');
    


    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')
    //Route::get('/task_detail', [TaskController::class, 'showTaskDetails']);
});

Auth::routes();





