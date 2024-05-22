<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CalendarController;


//Route::get('/home', [WelcomeController::class, 'index'])->middleware('userAuth');

Route::get('/welcome', [WelcomeController::class, 'ShowLoginPage']);

Route::post('/welcome', [WelcomeController::class, 'login']);

//Route::get('/logout', [WelcomeController::class, 'logout']);

Route::get('/home', [HomeController::class, 'ShowHomePage'])->name('home');

Route::get('/set', [HomeController::class, 'ShowSet'])->name('set');

Route::get('/calendar', [CalendarController::class, 'ShowCalendarPage'])->name('calendar');

Route::get('/calendar/events', [CalendarController::class, 'getEvents']);

Route::get('/course', [CourseController::class, 'ShowCourseSearch'])->name('course_search');

Route::get('/course/dashboard', [CourseController::class, 'ShowCourseDashboard'])->name('course_dashboard');

Route::get('/course/table', [CourseController::class, 'ShowCourseTable'])->name('course_table');
?>