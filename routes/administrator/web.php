<?php

use App\Http\Controllers\administrator\AccountController;
use App\Http\Controllers\administrator\DepartmentController;
use App\Http\Controllers\administrator\DieselController;
use App\Http\Controllers\administrator\MaintenanceController;
use App\Http\Controllers\administrator\PersonalController;
use App\Http\Controllers\administrator\ProjectController;
use App\Http\Controllers\administrator\ProtectionController;
use App\Http\Controllers\administrator\StockInController;
use App\Http\Controllers\administrator\SupplierController;
use App\Http\Controllers\administrator\TransferHistoriesController;
use App\Http\Controllers\administrator\UnitController;
use App\Http\Controllers\administrator\VihicleController;
use App\Http\Controllers\administrator\WarehouseController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('check.login')->name('admin.')->group(function(){

    Route::resource('department', DepartmentController::class);
    Route::controller(DepartmentController::class)->group(function(){
        Route::post('department/slug', 'createSlug')->name('department.slug');
        Route::post('department/restore/{id}', 'restore')->name('department.restore');
        Route::post('department/force-delete/{id}', 'forceDelete')->name('department.force.delete');
    });

    Route::resource('diesel', DieselController::class);
    Route::controller(DieselController::class)->group(function(){
        Route::post('diesel/restore/{id}', 'restore')->name('diesel.restore');
        Route::post('diesel/force-delete/{id}', 'forceDelete')->name('diesel.force.delete');
    });

    Route::resource('maintenance', MaintenanceController::class);
    Route::controller(MaintenanceController::class)->group(function(){
        Route::post('maintenance/restore/{id}', 'restore')->name('maintenance.restore');
        Route::post('maintenance/force-delete/{id}', 'forceDelete')->name('maintenance.force.delete');
    });
    
    Route::resource('personal', PersonalController::class);
    Route::controller(PersonalController::class)->group(function(){
        Route::post('personal/restore/{id}', 'restore')->name('personal.restore');
        Route::post('personal/force-delete/{id}', 'forceDelete')->name('personal.force.delete');
    });

    Route::resource('project', ProjectController::class);
    Route::controller(ProjectController::class)->group(function(){
        Route::post('project/slug', 'createSlug')->name('project.slug');
        Route::post('project/restore/{id}', 'restore')->name('project.restore');
        Route::post('project/force-delete/{id}', 'forceDelete')->name('project.force.delete');
    });

    Route::resource('protection', ProtectionController::class);
    Route::controller(ProtectionController::class)->group(function(){
        Route::post('protection/restore/{id}', 'restore')->name('protection.restore');
        Route::post('protection/force-delete/{id}', 'forceDelete')->name('protection.force.delete');
    });

    Route::resource('transfer', TransferHistoriesController::class);
    Route::controller(TransferHistoriesController::class)->group(function(){
        Route::post('transfer/form-vihicle', 'formVihicle')->name('transfer.form.vihicle');
        Route::post('transfer/form-deliver', 'formDeliver')->name('transfer.form.deliver');
        Route::post('transfer/form-receiver', 'formReceiver')->name('transfer.form.receiver');
        Route::post('transfer/restore/{id}', 'restore')->name('transfer.restore');
        Route::post('transfer/force-delete/{id}', 'forceDelete')->name('transfer.force.delete');
    });

    Route::resource('unit', UnitController::class);
    Route::controller(UnitController::class)->group(function(){
        Route::post('unit/slug', 'createSlug')->name('unit.slug');
        Route::post('unit/restore/{id}', 'restore')->name('unit.restore');
        Route::post('unit/force-delete/{id}', 'forceDelete')->name('unit.force.delete');
    });

    Route::resource('vihicle', VihicleController::class);
    Route::controller(VihicleController::class)->group(function(){
        Route::post('vihicle/restore/{id}', 'restore')->name('vihicle.restore');
        Route::post('vihicle/force-delete/{id}', 'forceDelete')->name('vihicle.force.delete');
    });

    Route::resource('warehouse', WarehouseController::class);
    Route::controller(WarehouseController::class)->group(function(){
        Route::post('warehouse/restore/{id}', 'restore')->name('warehouse.restore');
        Route::post('warehouse/force-delete/{id}', 'forceDelete')->name('warehouse.force.delete');
    });

    Route::resource('supplier', SupplierController::class);
    Route::controller(SupplierController::class)->group(function(){
        Route::post('supplier/restore/{id}', 'restore')->name('supplier.restore');
        Route::post('supplier/force-delete/{id}', 'forceDelete')->name('supplier.force.delete');
    });

    Route::resource('stock-in', StockInController::class);
    Route::controller(StockInController::class)->group(function(){
        Route::post('stock-in/restore/{id}', 'restore')->name('stock-in.restore');
        Route::post('stock-in/force-delete/{id}', 'forceDelete')->name('stock-in.force.delete');
    });

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('account', AccountController::class)->middleware('check.admin');
    Route::middleware('check.admin')->controller(AccountController::class)->group(function(){
        Route::post('account/restore/{id}', 'restore')->name('account.restore');
        Route::post('account/force-delete/{id}', 'forceDelete')->name('account.force.delete');
    });
});

