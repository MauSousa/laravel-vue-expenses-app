<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenseController;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {

    // TODO: Keep looking for pagination

    $today = Carbon::now()->format('Y-m-d');
    // dd(Expense::with(['payment', 'store'])->where('user_id', Auth::user()->id)->where('created_at', 'LIKE', "%{$today}%")->latest()->get());

    return Inertia::render('Dashboard', [
        'expenses' => Expense::with(['payment', 'store'])->where('user_id', Auth::user()->id)->where('created_at', 'LIKE', "%{$today}%")->latest()->get(),
        'today' => $today
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard', [ExpenseController::class, 'filter_date'])
    ->middleware(['auth', 'verified'])
    ->name('expenses.filter_date');
Route::resource('/expenses', ExpenseController::class)
    ->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
