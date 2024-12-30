<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'index']);

Route::get('/admin/login', [AuthController::class, 'adminLogin']);
Route::post('/admin/user-login', [AuthController::class, 'adminLogger']);

Route::get('/student/login', [AuthController::class, 'studentLogin']);
Route::get('/student/register', [AuthController::class, 'studentRegister']);
Route::post('/student/registration', [AuthController::class, 'studentRegistration']);
Route::post('/student/user-login', [AuthController::class, 'studentLogger']);

Route::get('/teacher/login', [AuthController::class, 'teacherLogin']);
Route::get('/teacher/register', [AuthController::class, 'teacherRegister']);
Route::post('/teacher/registration', [AuthController::class, 'teacherRegistration']);
Route::post('/teacher/user-login', [AuthController::class, 'teacherLogger']);

Route::middleware(['checkLogin'])->group(function () {

    Route::middleware(['checkIfAdmin'])->group(function () {
        
        Route::get('admin/home', [AdminController::class, 'adminHome']);

        Route::get('admin/add-courses', [AdminController::class, 'addCourse']);
        Route::post('courses/store', [AdminController::class, 'storeCourse']);
        Route::get('admin/manage-courses', [AdminController::class, 'manageCourse']);
        Route::get('admin/edit-course/{id}', [AdminController::class, 'editCourse']);
        Route::post('admin/update-course/{id}', [AdminController::class, 'updateCourse']);
        Route::get('admin/delete-course/{id}', [AdminController::class, 'deleteCourse']);

        Route::get('admin/users', [AdminController::class, 'users']);

        Route::get('admin/teachers', [AdminController::class, 'getTeachers']);
        Route::get('admin/search-teacher', [AdminController::class, 'searchTeacher']);
        Route::get('admin/edit-teacher/{id}', [AdminController::class, 'editTeacher']);
        Route::post('admin/update-teacher/{id}', [AdminController::class, 'updateTeacher']);
        Route::get('admin/delete-teacher/{id}', [AdminController::class, 'deleteTeacher']);

        Route::get('admin/students', [AdminController::class, 'getStudents']);
        Route::get('admin/search-student', [AdminController::class, 'searchStudent']);
        Route::get('admin/edit-student/{id}', [AdminController::class, 'editStudent']);
        Route::post('admin/update-student/{id}', [AdminController::class, 'updateStudent']);
        Route::get('admin/delete-student/{id}', [AdminController::class, 'deleteStudent']);
    });

    Route::middleware(['checkIfStudent'])->group(function () {
        Route::get('/student/home', [StudentController::class, 'studentHome']);
        Route::get('/student/enroll', [StudentController::class, 'enroll']);
        Route::post('/student/storeCourse', [StudentController::class, 'storeEnrolment']);
        Route::get('/student/class-schedule', [StudentController::class, 'studentClassSchedule']);
        Route::get('/student/exam-schedule', [StudentController::class, 'studentExamSchedule']);
    });

    Route::middleware(['checkIfTeacher'])->group(function () {
        Route::get('/teacher/home', [TeacherController::class, 'teacherHome']);
        Route::get('/teacher/add-course', [TeacherController::class, 'addCourseMenu']);
        Route::post('/teacher/storeCourse', [TeacherController::class, 'teacherCourses']);
        Route::get('/teacher/manageCourse', [TeacherController::class, 'manageCourse']);
        Route::get('/teacher/delete-course/{id}', [TeacherController::class, 'deleteCourse']);
        Route::get('/teacher/class-routine', [TeacherController::class, 'routineMenu']);
        Route::get('/teacher/courseRoutine/{id}', [TeacherController::class, 'routineEntry']);
        Route::post('/classSchedule/store/{id}', [TeacherController::class, 'classScheduleStore']);
        Route::get('/teacher/exam-schedule', [TeacherController::class, 'examMenu']);
        Route::post('/teacher/exam-store', [TeacherController::class, 'examScheduleStore']);
    });

    Route::get('/logout', [AuthController::class, 'logout']);
});
