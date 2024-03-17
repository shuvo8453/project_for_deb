<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\Project\ProjectController;
use App\Http\Controllers\Api\v1\Task\TaskController;

/*
|--------------------------------------------------------------------------
| V1 API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register V1 API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('registration', 'registration');
});

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum'])->group(function () {
    /*
   |--------------------------------------------------------------------------
   | Auth related route
   |--------------------------------------------------------------------------
   */
    Route::controller(AuthController::class)->group(function () {
        Route::get('/me', 'me');
        Route::post('/team-member/create', 'createTeamMember');
        Route::get('/logout', 'logout');
    });
    /*
    |--------------------------------------------------------------------------
    | Manager related route
    |--------------------------------------------------------------------------
    */
    Route::middleware(['ability:role:manager'])->group(function () {

        Route::post('/team-member/create', [AuthController::class, 'createTeamMember']);
        /*
        |--------------------------------------------------------------------------
        | Project Resource
        |--------------------------------------------------------------------------
        */
        Route::apiResource('project', ProjectController::class)->only(['index', 'store']);
        /*
        |--------------------------------------------------------------------------
        | Task Resource
        |--------------------------------------------------------------------------
        */
        Route::apiResource('task', TaskController::class)->only(['index', 'store']);

        Route::controller(TaskController::class)->group(function () {
            Route::post('/assign-task/{id}', 'assignTask');
            Route::get('/get-team-mate', 'getTeamMate');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Manager related route
    |--------------------------------------------------------------------------
    */
    Route::middleware(['ability:role:teammate'])->group(function () {
        /*
        |--------------------------------------------------------------------------
        | Task Resource
        |--------------------------------------------------------------------------
        */
        Route::controller(TaskController::class)->group(function () {
            Route::get('/get/assign-task', 'getAssignTask');
            Route::get('/get/project-list', 'getProjectList');
            Route::post('/update-task/status/{id}', 'upateTaskStatus');
        });
    });
});
