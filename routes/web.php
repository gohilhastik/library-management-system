<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\BookIssueController;
use App\Http\Controllers\Admin\ReportController;


Route::redirect('/', '/dashboard');

// Route::get('/dashboard', [DashboardController::class,'index'])
// ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->
    group(function(){
        Route::get('/dashboard', [DashboardController::class,'index'])->
        name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('categories', CategoryController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('authors', AuthorController::class);

});

Route::middleware(['auth'])->group(function () {

    Route::resource('publishers', PublisherController::class);

});

Route::middleware(['auth'])->group(function () {
     Route::resource('books', BookController::class);
});

Route::middleware(['auth'])->group(function () {
     Route::resource('students', StudentController::class);
});

Route::middleware(['auth'])->group(function () {
     Route::resource('issues', BookIssueController::class);
});

Route::patch(
    'issues/{bookIssue}/return',
    [BookIssueController::class, 'return']
)->name('issues.return');

Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');

Route::get('/reports/issued', [ReportController::class, 'issuedBooks'])
    ->name('reports.issued');

Route::get('/reports/returned', [ReportController::class, 'returnedBooks'])
    ->name('reports.returned');

Route::get('/reports/overdue', [ReportController::class, 'overdueBooks'])
    ->name('reports.overdue');

Route::get('/reports/student-history/{id}', [ReportController::class, 'studentHistory'])
    ->name('reports.student-history');
    
require __DIR__.'/auth.php';
