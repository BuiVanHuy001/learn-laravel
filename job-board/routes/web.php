<?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\JobApplicationController;
    use App\Http\Controllers\JobController;
    use App\Http\Controllers\MyJobApplicationController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return to_route('jobs.index');
    });

    Route::resource('jobs', JobController::class);

    Route::get('login', fn() => to_route('auth.create'))->name('login');
    Route::delete('logout', fn() => to_route('auth.destroy'))->name('logout');
    Route::resource('auth', AuthController::class)->only(['create', 'store']);
    Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');

    Route::middleware('auth')->group(function () {
        Route::resource('job.application', JobApplicationController::class)->only(['create', 'store', 'destroy']);
        Route::resource('my-job-applications', MyJobApplicationController::class)->only(['index', 'destroy']);
    });
