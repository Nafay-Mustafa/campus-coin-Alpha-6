<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\AdminController;

Route::get('/', fn()=>view('home'))->name('home');

Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class,'authenticate'])->name('admin.authenticate');

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard',[FinanceController::class,'dashboard'])->name('dashboard');

    Route::post('/transactions',[FinanceController::class,'storeTransaction'])->name('transactions.store');
    Route::get('/transactions/{transaction}/edit',[FinanceController::class,'editTransaction'])->name('transactions.edit');
    Route::put('/transactions/{transaction}',[FinanceController::class,'updateTransaction'])->name('transactions.update');
    Route::delete('/transactions/{transaction}',[FinanceController::class,'destroyTransaction'])->name('transactions.destroy');

    Route::post('/categories',[FinanceController::class,'storeCategory'])->name('categories.store');
    Route::delete('/categories/{category}',[FinanceController::class,'destroyCategory'])->name('categories.destroy');

    Route::get('/budgets',[FinanceController::class,'budgets'])->name('budgets.index');
    Route::post('/budgets',[FinanceController::class,'storeBudget'])->name('budgets.store');
    Route::delete('/budgets/{budget}',[FinanceController::class,'destroyBudget'])->name('budgets.destroy');

    Route::get('/reports',[FinanceController::class,'reports'])->name('reports.index');
    Route::get('/reports/csv',[FinanceController::class,'exportCsv'])->name('reports.csv');
    Route::post('/transactions/import',[FinanceController::class,'importCsv'])->name('transactions.import');
    Route::post('/bookmarks',[FinanceController::class,'bookmark'])->name('bookmarks.store');
    Route::get('/bookmarks',[FinanceController::class,'bookmarks'])->name('bookmarks.index');
    Route::delete('/bookmarks/{bookmark}',[FinanceController::class,'deleteBookmark'])->name('bookmarks.destroy');
    Route::get('/insights',[FinanceController::class,'insights'])->name('insights.index');
    Route::get('/profile-settings',[App\Http\Controllers\ProfileController::class,'edit'])->name('profile.settings');
    Route::put('/profile-settings',[App\Http\Controllers\ProfileController::class,'update'])->name('profile.settings.update');
    Route::get('/sitemap',[FinanceController::class,'sitemap'])->name('sitemap');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[AdminController::class,'dashboard'])->name('dashboard');
    Route::post('/categories',[AdminController::class,'addCategory'])->name('categories.store');
    Route::delete('/categories/{category}',[AdminController::class,'deleteCategory'])->name('categories.destroy');
});
