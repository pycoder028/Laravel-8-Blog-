<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[\App\Http\Controllers\Frontend\FrontendController::class,'index']);
Route::get('tutorial/{category_slug}',[\App\Http\Controllers\Frontend\FrontendController::class,'viewCategoryPost']);
Route::get('/tutorial/{category_slug}/{post_slug}',[\App\Http\Controllers\Frontend\FrontendController::class,'viewPost']);

/* Comment System */
Route::post('comments',[\App\Http\Controllers\Frontend\CommentController::class, 'store']);
Route::post('/delete-comment',[\App\Http\Controllers\Frontend\CommentController::class, 'destroy']);


/* Admin routes group */
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){

    Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index']);
    Route::get('/category',[\App\Http\Controllers\Admin\CategoryController::class,'index']);
    Route::get('/add-category',[\App\Http\Controllers\Admin\CategoryController::class,'create']);
    Route::post('/add-category',[\App\Http\Controllers\Admin\CategoryController::class,'store']);
    Route::get('/edit-category/{category_id}',[\App\Http\Controllers\Admin\CategoryController::class,'edit']);
    Route::put('/update-category/{category_id}',[\App\Http\Controllers\Admin\CategoryController::class,'update']);
    /* Route::get('/delete-category/{category_id}',[\App\Http\Controllers\Admin\CategoryController::class,'destroy']); */
    Route::post('/delete-category', [\App\Http\Controllers\Admin\CategoryController::class,'destroy']);

    Route::get('/posts', [\App\Http\Controllers\Admin\PostController::class,'index']);
    Route::get('/add-post', [\App\Http\Controllers\Admin\PostController::class,'create']);
    Route::post('/add-post', [\App\Http\Controllers\Admin\PostController::class,'store']);
    Route::get('/post/{post_id}', [\App\Http\Controllers\Admin\PostController::class,'edit']);
    Route::put('/update-post/{post_id}', [\App\Http\Controllers\Admin\PostController::class,'update']);
    Route::get('/delete-post/{post_id}', [\App\Http\Controllers\Admin\PostController::class,'destroy']);

    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('user/{user_id}', [\App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('update-user/{user_id}', [\App\Http\Controllers\Admin\UserController::class, 'update']);

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index']);
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'saveData']);

    Route::get('/contents', [\App\Http\Controllers\Admin\ContentController::class, 'index']);
    Route::post('/contents', [\App\Http\Controllers\Admin\ContentController::class, 'saveContent']);

    Route::get('/gettouch', [\App\Http\Controllers\Admin\GettouchController::class, 'index']);
    Route::post('/gettouch', [\App\Http\Controllers\Admin\GettouchController::class, 'saveTouch']);

});
