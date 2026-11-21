<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminContentController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('register.store');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.store');

Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

Route::view('/register', 'auth.register')->name('register');

Route::view('/login', 'auth.login')->name('login');

Route::view('/quiz', 'quiz', ['category' => null])->name('quiz.index');

Route::get('/quiz/{category}', function (string $category) {
    return view('quiz', ['category' => $category]);
})->whereIn('category', ['haki', 'hpp'])->name('quiz.category');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::post('/logout', function (Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');

    Route::view('/profile', 'profile')->name('profile.show');

    Route::patch('/profile', [AuthController::class, 'updateProfile'])
    ->name('profile.update');

    Route::get('/quiz/{category}/{topic}/materi', function (string $category, string $topic) {
    return view('quiz', [
        'category' => $category,
        'topic' => (int) $topic,
        'stage' => 'materi',
    ]);
        })->whereIn('category', ['haki', 'hpp'])
            ->where('topic', '[1-3]')
            ->name('quiz.material');

        Route::get('/quiz/{category}/{topic}/soal', function (string $category, string $topic) {
            return view('quiz', [
                'category' => $category,
                'topic' => (int) $topic,
                'stage' => 'soal',
            ]);
        })->whereIn('category', ['haki', 'hpp'])
            ->where('topic', '[1-3]')
            ->name('quiz.play');
});

Route::middleware(['auth', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminContentController::class, 'index'])->name('index');
        Route::post('/contents', [AdminContentController::class, 'store'])->name('store');
        Route::patch('/contents/{content}', [AdminContentController::class, 'update'])->name('update');
        Route::delete('/contents/{content}', [AdminContentController::class, 'destroy'])->name('destroy');
    });