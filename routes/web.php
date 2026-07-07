<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CalendarController;


//Route::get('/home', [WelcomeController::class, 'index'])->middleware('userAuth');

Route::get('/welcome', [WelcomeController::class, 'ShowLoginPage']);

Route::post('/welcome/login', [WelcomeController::class, 'login']);

Route::post('/welcome/register', [WelcomeController::class, 'register']);

Route::middleware(['sess'])->group(function () {
    Route::get('/logout', [WelcomeController::class, 'logout'])->name('logout');
    
    Route::get('/home', [HomeController::class, 'ShowHomePage'])->name('home');
    
    Route::get('/home/dashboard', [CourseController::class, 'getDashboardCourses']);
    
    Route::post('/home/calendar', [CalendarController::class, 'getTodayEvents']);
    
    Route::get('/home/eatSquirrel', [HomeController::class, 'ShoweatSquirrel'])->name('eatSquirrel');
    
    Route::get('/home/russia', [HomeController::class, 'ShowGame2'])->name('Game2');
    
    Route::get('/set', [HomeController::class, 'ShowSet'])->name('set');
    
    Route::post('/set', [HomeController::class, 'ChangeUserData'])->name('change.user.data');
    
    Route::get('/calendar', [CalendarController::class, 'ShowCalendarPage'])->name('calendar');
    
    Route::get('/calendar/events', [CalendarController::class, 'getEvents']);
    
    Route::post('/calendar/events', [CalendarController::class, 'addEvent']);
    
    Route::delete('/calendar/events', [CalendarController::class, 'deleteEvent']);
    
    Route::get('/course', [CourseController::class, 'ShowCourseSearch'])->name('course_search');
    
    Route::post('/course/add', [CourseController::class, 'AddCourse']);
    
    Route::get('/course/dashboard', [CourseController::class, 'ShowCourseDashboard'])->name('course_dashboard');
    
    Route::get('/course/dashboard/my', [CourseController::class, 'getDashboardCourses']);
    
    Route::post('/course/change', [CourseController::class, 'ChangeCourseCategory']);
    
    Route::get('/course/table', [CourseController::class, 'ShowCourseTable'])->name('course_table');
    
    Route::get('/course/table/my', [CourseController::class, 'getTableCourses']);
    
    Route::delete('/course/delete', [CourseController::class, 'deleteCourse']);
});
?>