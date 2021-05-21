<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\site\HomeController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\VisitorController;
use Illuminate\Support\Facades\Route;





Route::get('/',[HomeController::class,'homePage']);

Route::get('/courses', function () {
    return view('site/courses');
});

Route::get('/projects', function () {
    return view('site/projects');
});

Route::get('/blog', function () {
    return view('site/blogs');
});

Route::get('/contact', function () {
    return view('site/contact');
});




/**
 * Admin - Dashboard Routes here
 */


Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('admin/dashboard');
    });

    Route::get('/visitors',[VisitorController::class,'get']);
    Route::post('/deleteVisitor',[VisitorController::class,'onDelete']);


    Route::get('/services',[ServiceController::class,'get']);
    Route::post('/insertService',[ServiceController::class,'onInsert']);
    Route::post('/updateSevice',[ServiceController::class,'onUpdate']);
    Route::post('/deleteService',[ServiceController::class,'onDelete']);

    Route::get('/courses',[CourseController::class,'get']);
    Route::post('/insertCourse',[CourseController::class,'onInsert']);
    Route::post('/updateCourse',[CourseController::class,'onUpdate']);
    Route::post('/delelteCourse',[CourseController::class,'onDelete']);

    Route::get('/projects',[ProjectController::class,'get']);
    Route::post('/insertProject',[ProjectController::class,'onInsert']);
    Route::post('/updateProject',[ProjectController::class,'onUpdate']);
    Route::post('/delelteProject',[ProjectController::class,'onDelete']);


    Route::get('/blogs',[BlogController::class,'get']);
    Route::post('/insertBlog',[BlogController::class,'onInsert']);
    Route::post('/updateBlog',[BlogController::class,'onUpdate']);
    Route::post('/delelteBlog',[BlogController::class,'onDelete']);

    

});



