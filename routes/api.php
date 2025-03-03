<?php
use App\Http\Controllers\Api\ActionController;
use App\Http\Controllers\Api\ChallengeController;
use App\Http\Controllers\Api\RankingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StepController;
use App\Http\Controllers\Api\TrashController;
use Illuminate\Support\Facades\Route;

/**
 * Inscription
 */

Route::post('/register', [UserController::class, 'register']);

/**
 * Connexion
 */
Route::post('/login', [UserController::class, 'login']);


/**
 * Liste des utilisateurs
 */
Route::get('/users', [UserController::class, 'index']);

/**
 * Reset Password
 */
Route::post('/reset-password', [UserController::class, 'resetPassword']);

/**
 * Routes protégées
 */

Route::get('/challenge', [ActionController::class, 'testChallenge']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/me', [UserController::class, 'me']);

    Route::get('/autologin', [UserController::class, 'autologin']);

    Route::get('/user/points', [UserController::class, 'getPoints']);

    Route::get('/logout', [UserController::class, 'logout']);

    Route::post('/save-step', [StepController::class, 'store']);

    Route::post('/user/update', [UserController::class, 'update']);

    Route::get('/challenges', [ChallengeController::class, 'index']);

    Route::get('/user/weekSteps', [StepController::class, 'getWeeklySteps']);

    Route::post('/action', [ActionController::class, 'create']);

    Route::get('/ranking', [RankingController::class, 'index']);
});
