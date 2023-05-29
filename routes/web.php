<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\OgrenciKabul;
use App\Http\Controllers\ogrenciler;
use App\Http\Controllers\OgrenciNotlar;
use App\Http\Controllers\OgretmenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UstYonetici\UstyoneticiController;


Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('panel', [MainController::class, 'Dashboard'])->name('dashboard');
    Route::get('okundu/{id}', [MainController::class, 'okundIsaretle'])->name('okundu');
    Route::get('quiz/detay/{slug}', [MainController::class, 'quizDetail'])->name('quiz.detail');
    Route::get('quiz/{slug}', [MainController::class, 'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result', [MainController::class, 'result'])->name('quiz.result');
    Route::post('mesajYolla', [MainController::class, 'mesajGonder'])->name('mesajg');
    Route::resource('ogretmen', OgretmenController::class);

});


Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function () {
    Route::get('quizzes/{id}', [QuizController::class, 'destroy'])->whereNumber('id')->name('quizzes.destroy');
    Route::get('quiz/{quiz_id}/questions/{id}', [QuestionController::class, 'destroy'])->whereNumber('id')->name('questions.destroy');
    Route::resource('quizzes', QuizController::class);
    Route::resource('quiz/{quiz_id}/questions', QuestionController::class);
    Route::resource('ogrenciKabul', OgrenciKabul::class);
    Route::resource('ogrenciler', ogrenciler::class);
    Route::resource('notlar', OgrenciNotlar::class);
    Route::get('ogrenciKabul/{id}', [OgrenciKabul::class, 'destroy'])->name('ogrenciKabul.destroy');
});

Route::group(['middleware' => ['auth', 'ustYonetici']], function () {
    Route::get('dondur/{id}/{type}', [MainController::class, 'tipGuncelle'])->name('tipDegistir');
    
    Route::get('loglar', [UstyoneticiController::class, 'loglarıGoster'])->name('sistemLoglari');
    Route::get('loglar/yonetici', [UstyoneticiController::class, 'LogYonetici'])->name('loglar.yonetici');
    Route::get('loglar/dashboard', [UstyoneticiController::class, 'LogDashboard'])->name('loglar.dashboard');
    Route::get('loglar/mesajlar', [UstyoneticiController::class, 'LogMesajlar'])->name('loglar.mesajlar');
    Route::get('loglar/sinavlar', [UstyoneticiController::class, 'LogSinavlar'])->name('loglar.sinavlar');
    Route::get('loglar/notlar', [UstyoneticiController::class, 'LogNotlar'])->name('loglar.notlar');
    Route::get('loglar/kayitlar', [UstyoneticiController::class, 'LogKayitlar'])->name('loglar.kayitlar');
    Route::get('loglar/ogrKabul', [UstyoneticiController::class, 'LogOgrKabul'])->name('loglar.ogrKabul');
    Route::get('loglar/ogrSilme', [UstyoneticiController::class, 'LogOgrSilme'])->name('loglar.ogrSilme');
    Route::get('loglar/sinavGirilme', [UstyoneticiController::class, 'LogSinavGirilme'])->name('loglar.sinavGirilme');
});