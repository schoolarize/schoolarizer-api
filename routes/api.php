<?php
use Illuminate\Support\Facades\Route;

use Schoolarize\Schoolarizer\Http\Controllers\Auth\AuthController;
use Schoolarize\Schoolarizer\Http\Controllers\User\UserController;
use Schoolarize\Schoolarizer\Http\Controllers\User\ActivityLogController;
use Schoolarize\Schoolarizer\Http\Controllers\Session\SessionController;
use Schoolarize\Schoolarizer\Http\Controllers\Term\TermController;
use Schoolarize\Schoolarizer\Http\Controllers\Clazz\ClazzController;

use App\User;

Route::group(['prefix' => config('schoolarizer.route_prefix', 'api')], function(){

    Route::group(['middleware' => ['guest:api']],function () {
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::group(['middleware' => ['auth:api']],function () {

        Route::post('logout', [AuthController::class, 'logout']);

        /**
         * User Management Routes
         */
        Route::get('/users', [UserController::class, 'index'])->middleware('permissionOrRole:admin');
        Route::post('/users/create', [UserController::class, 'store']);
        Route::get('/users/show/{id}', [UserController::class, 'show']);
        Route::post('/users/update/{id}', [UserController::class, 'update']);
        Route::post('/users/update/{field}/{id}', [UserController::class, 'updateField']);
        Route::get('/users/destroy/{id}', [UserController::class, 'destroy']);

        /**
         * Users ActivityLog Routes
         */
        Route::get('/users/activity/logs/{id}', [ActivityLogController::class, 'index'])->middleware('permissionOrRole:admin');


        Route::get('/sessions', [SessionController::class, 'index']);
        Route::post('/sessions/store', [SessionController::class, 'store']);
        Route::get('/sessions/show/{id}', [SessionController::class, 'show']);
        Route::post('/sessions/update/{id}', [SessionController::class, 'update']);
        Route::get('/sessions/destroy/{id}', [SessionController::class, 'destroy']);

        Route::get('/sessions/terms/{session_id}', [TermController::class, 'index']);
        Route::post('/sessions/terms/store/{session_id}', [TermController::class, 'store']);
        Route::get('/sessions/terms/show/{term_id}', [TermController::class, 'show']);
        Route::post('/sessions/terms/update/{term_id}', [TermController::class, 'update']);
        Route::get('/sessions/terms/destroy/{term_id}', [TermController::class, 'destroy']);

        Route::get('/classes', [ClazzController::class, 'index']);
        Route::post('/classes/store', [ClazzController::class, 'store']);
        Route::get('/classes/show/{id}', [ClazzController::class, 'show']);
        Route::post('/classes/update/{id}', [ClazzController::class, 'update']);
        Route::get('/classes/destroy/{id}', [ClazzController::class, 'destroy']);




    });

});