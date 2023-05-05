<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\OgrenciKabul;
use App\Http\Controllers\OgretmenController;
use App\Models\ogrenci;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\MainController;


Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('panel', [MainController::class, 'Dashboard'])->name('dashboard');
    Route::get('quiz/detay/{slug}', [MainController::class, 'quizDetail'])->name('quiz.detail');
    Route::get('quiz/{slug}', [MainController::class, 'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result', [MainController::class, 'result'])->name('quiz.result');
    Route::resource('ogretmen', OgretmenController::class);

});


Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function () {
    Route::get('quizzes/{id}', [QuizController::class, 'destroy'])->whereNumber('id')->name('quizzes.destroy');
    Route::get('quiz/{quiz_id}/questions/{id}', [QuestionController::class, 'destroy'])->whereNumber('id')->name('questions.destroy');
    Route::resource('quizzes', QuizController::class);
    Route::resource('quiz/{quiz_id}/questions', QuestionController::class);
    Route::resource('ogrenciKabul', OgrenciKabul::class);
    Route::get('ogrenciKabul/{id}', [OgrenciKabul::class, 'destroy'])->name('ogrenciKabul.destroy');



});