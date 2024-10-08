<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PdfController;
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
    $today = request()->query('date') ?? Carbon::now()->format('Y-m-d');

    return Inertia::render('Dashboard', [
        'date' => $today,
        'expenses' => Expense::with(['payment', 'store'])
            ->where('user_id', Auth::user()
                ->id)->where('created_at', 'LIKE', "%{$today}%")
            ->latest()->paginate(3)->withQueryString()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/expenses', ExpenseController::class)
    ->middleware(['auth', 'verified']);

Route::get('/pdf/{user}', [PdfController::class, 'monthlyExpenses'])
    ->where('user', '[0-9]+')
    ->where('mont', '[0-9]+')
    ->middleware(['auth', 'verified'])
    ->name('pdf.month');

Route::get('/pdf/{user}/{expense}', [PdfController::class, 'stream'])
    ->where('user', '[0-9]+')
    ->where('expense', '[0-9]+')
    ->middleware(['auth', 'verified'])
    ->name('pdf.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
