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

Route::post('/calendar/events', [CalendarController::class, 'addEvent']);

Route::delete('/calendar/events', [CalendarController::class, 'deleteEvent']);

Route::get('/course', [CourseController::class, 'ShowCourseSearch'])->name('course_search');

Route::post('/course/add', [CourseController::class, 'AddCourse']);

Route::get('/course/dashboard', [CourseController::class, 'ShowCourseDashboard'])->name('course_dashboard');

Route::get('/course/table', [CourseController::class, 'ShowCourseTable'])->name('course_table');

Route::get('/course/table/my', [CourseController::class, 'getCourses']);

Route::delete('/course/delete', [CourseController::class, 'deleteCourse']);
?>