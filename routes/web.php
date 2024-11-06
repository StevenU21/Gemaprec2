<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MaintenanceTypeController;
use App\Http\Controllers\PcModelController;
use App\Http\Controllers\PcTypeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UbicationController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/catalog-counts', [HomeController::class, 'getCatalogCounts']);


    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::get('/histories', [HistoryController::class, 'index'])->name('histories.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{id}/show', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{id}/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('/reports/export-all', [ReportController::class, 'exportAll'])->name('reports.exportAll');
    Route::get('export-report-pdf/{id}', [ReportController::class, 'exportPdf'])->name('exports.reportPDF');

    Route::get('/calendars/events', [CalendarController::class, 'events']);
    Route::resource('/clients', ClientController::class);
    Route::resource('/brands', BrandController::class);
    Route::resource('/pc-models', PcModelController::class);
    Route::resource('/pc-types', PcTypeController::class);
    Route::resource('/computers', ComputerController::class);
    Route::resource('/activities', ActivityController::class);
    Route::resource('/ubications', UbicationController::class);
    Route::resource('/activity-types', ActivityTypeController::class);
    Route::resource('/maintenance-types', MaintenanceTypeController::class);

    Route::resource('/maintenances', MaintenanceController::class)->only(['show', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
});
