<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return redirect()->back()->with(['msg' => 'Cache Cleared', 'type' => 'success']);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('auth/check', [DashboardController::class, 'authCheck'])->name('auth.check');

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('quiz/create', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('quiz', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('quiz/{id}', [QuizController::class, 'single'])->name('quiz.single');
    Route::get('quiz/{id}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::put('quiz/{id}', [QuizController::class, 'update'])->name('quiz.update');
    Route::delete('quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');

    Route::get('question', [QuestionController::class, 'index'])->name('question.index');
    Route::get('question/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('question', [QuestionController::class, 'store'])->name('question.store');
    Route::get('question/{id}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('question/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('question/{id}', [QuestionController::class, 'destroy'])->name('question.destroy');

    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('course', [CourseController::class, 'index'])->name('course.index');
    Route::get('course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('course', [CourseController::class, 'store'])->name('course.store');
    Route::get('course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('course/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('course/{id}', [CourseController::class, 'destroy'])->name('course.destroy');

    Route::get('lesson', [CourseController::class, 'index'])->name('lesson.index');
    Route::get('lesson/create', [CourseController::class, 'create'])->name('lesson.create');
    Route::post('lesson', [CourseController::class, 'store'])->name('lesson.store');
    Route::get('lesson/{id}/edit', [CourseController::class, 'edit'])->name('lesson.edit');
    Route::put('lesson/{id}', [CourseController::class, 'update'])->name('lesson.update');
    Route::delete('lesson/{id}', [CourseController::class, 'destroy'])->name('lesson.destroy');

});




