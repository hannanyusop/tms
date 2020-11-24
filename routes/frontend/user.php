<?php

use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use Tabuna\Breadcrumbs\Trail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\User\Lorry\LorryController;
use App\Http\Controllers\Frontend\User\Lorry\ServiceController;
use App\Http\Controllers\Frontend\User\Lorry\InsuranceController;
use App\Http\Controllers\Frontend\User\Lorry\RepairController;
use App\Http\Controllers\Frontend\User\NotificationController;
use App\Http\Controllers\Frontend\User\Lorry\InstallmentController;

Route::group(['as' => 'user.', 'middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('is_user')
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Dashboard'), route('frontend.user.dashboard'));
        });

    Route::get('account', [AccountController::class, 'index'])
        ->name('account')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Account'), route('frontend.user.account'));
        });

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::group(['prefix' => 'lorry/', 'as' => 'lorry.'], function (){

        Route::get('list', [LorryController::class, 'index'])->name('index');
        Route::get('create', [LorryController::class, 'create'])->name('create');
        Route::post('create', [LorryController::class, 'insert'])->name('insert');
        Route::get('edit/{id}', [LorryController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [LorryController::class, 'update'])->name('update');
        Route::get('{id}', [LorryController::class, 'view'])->name('view');


        Route::group(['prefix' => 'insurance/', 'as' => 'insurance.'], function (){

            Route::get('list', [InsuranceController::class, 'index'])->name('index');
            Route::get('view/{id}', [InsuranceController::class, 'view'])->name('view');
            Route::get('create/{lorry_id}', [InsuranceController::class, 'create'])->name('create');
            Route::post('create/{lorry_id}', [InsuranceController::class, 'insert'])->name('insert');
            Route::get('edit/{id}', [InsuranceController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [InsuranceController::class, 'update'])->name('update');
            Route::get('delete/{id}', [InsuranceController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'service/', 'as' => 'service.'], function (){

            Route::get('list', [ServiceController::class, 'index'])->name('index');
            Route::get('view/{id}', [ServiceController::class, 'view'])->name('view');
            Route::get('create/{lorry_id}', [ServiceController::class, 'create'])->name('create');
            Route::post('create/{lorry_id}', [ServiceController::class, 'insert'])->name('insert');
            Route::get('edit/{id}', [ServiceController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [ServiceController::class, 'update'])->name('update');
            Route::get('delete/{id}', [ServiceController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'repair/', 'as' => 'repair.'], function (){

            Route::get('list', [RepairController::class, 'index'])->name('index');
            Route::get('view/{id}', [RepairController::class, 'view'])->name('view');
            Route::get('create/{lorry_id}', [RepairController::class, 'create'])->name('create');
            Route::post('create/{lorry_id}', [RepairController::class, 'insert'])->name('insert');
            Route::get('edit/{id}', [RepairController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [RepairController::class, 'update'])->name('update');
            Route::get('delete/{id}', [RepairController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'installment/', 'as' => 'installment.'], function (){

            Route::get('list', [InstallmentController::class, 'index'])->name('index');
            Route::get('view/{date}', [InstallmentController::class, 'view'])->name('view');
            Route::get('create/', [InstallmentController::class, 'create'])->name('create');
            Route::post('create/', [InstallmentController::class, 'insert'])->name('insert');
            Route::get('delete/{id}', [InstallmentController::class, 'delete'])->name('delete');
        });

    });

    Route::group(['prefix' => 'notification/', 'as' => 'notification.'], function (){

        Route::get('tutorial', [NotificationController::class, 'tutorial'])->name('tutorial');
        Route::get('testing', [NotificationController::class, 'testing'])->name('testing');


    });

});
