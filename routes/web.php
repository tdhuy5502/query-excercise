<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)
->prefix('/users')
->as('users.')
->group(function(){
    Route::get('create','create')->name('create');
    Route::get('get-name','getName')->name('getName');
    Route::get('update-email','updateEmail')->name('updateEmail');
    Route::get('delete','deleteUser')->name('delete');
    Route::get('get-user-has-posts','getUserHas2Posts')->name('getUserHasPost');
    Route::get('findPostsCount','getPostsCount')->name('getCount');
});

Route::controller(PostController::class)
->prefix('/posts')
->as('posts.')
->group(function(){
    Route::get('create','create')->name('create');
    Route::get('find','findPostById')->name('find');
    Route::get('update-title','updateById')->name('update');
    Route::get('delete','delete')->name('delete');
    Route::get('createById','createById')->name('createById');
    Route::get('findByTitle','getPostHasTitle')->name('findByTitle');
});