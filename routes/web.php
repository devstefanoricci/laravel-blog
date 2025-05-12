<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryControllerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function ($str = null) {
    //return view('welcome')->with('str', $str);
    $str = "Visit Quickref.me";
    //$result = preg_match("/qu/i", $str);
    $result = "Stefano";
    return view('welcome')->with(['str'=> $str, 'result' => $result]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.resend');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::prefix('posts')->middleware(['auth'])->group(function () {
    Route::get('/index',  [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::get('/trashed',  [App\Http\Controllers\PostController::class, 'trashed'])->name('posts.trashed');
    Route::put('/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('/create',  [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('/posts',  [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::get('/{id}',  [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
    Route::get('/{id}/edit',  [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
    Route::put('/{id}',  [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
    Route::delete('/{id}',  [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/search',  [App\Http\Controllers\PostController::class, 'search'])->name('posts.search');

});

Route::prefix('categories')->group(function () {
    Route::get('/index',  [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create',  [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories',  [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}',  [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{id}/edit',  [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{id}',  [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}',  [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::prefix('comments')->group(function () {
    Route::get('/index',  [App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
    Route::get('/create',  [App\Http\Controllers\CommentController::class, 'create'])->name('comments.create');
    Route::post('/comments',  [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::get('/{id}',  [App\Http\Controllers\CommentController::class, 'show'])->name('comments.show');
    Route::get('/{id}/edit',  [App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/{id}',  [App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
    Route::delete('/{id}',  [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
});
