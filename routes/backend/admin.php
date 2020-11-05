<?php

use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SystemSettingController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });


Route::group(['prefix' => 'setting', 'as' => 'setting.'], function (){

    Route::get('', [SystemSettingController::class,'index'])->name('index');
    Route::post('save-notification', [SystemSettingController::class, 'saveNotification'])->name('save-notification');
    Route::post('save-system', [SystemSettingController::class, 'saveSystem'])->name('save-system');

    Route::get('testing-slack', [SystemSettingController::class,'testingSlack'])->name('testing-slack');


});

