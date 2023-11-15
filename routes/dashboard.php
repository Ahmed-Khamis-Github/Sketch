<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;


Route::group([
    
    'prefix'=>'dashboard',
    'as'=>'dashboard.' ,
    'middleware'=>['auth:admin,web']

],function(){

    Route::resource('users',UserController::class) ;

    Route::resource('categories',CategoryController::class) ;

    Route::put('projects/trash/{project}',[ProjectController::class,'restoreTrash'])->name('projects.trash.restore') ;
    Route::Delete('projects/trash/{project}',[ProjectController::class,'deleteTrash'])->name('projects.trash.delete') ;
    Route::get('projects/trash',[ProjectController::class,'showTrash'])->name('projects.trash') ;


    Route::resource('projects',ProjectController::class) ;



}) ;