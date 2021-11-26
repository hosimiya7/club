<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\MemberController;
use App\Models\Member;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [StudentController::class, 'show'])->name('student.show');
Route::post('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/member/delete', [MemberController::class, 'delete'])->name('member.delete');
Route::post('/club/create', [ClubController::class, 'create'])->name('club.create');
Route::post('/club/approval', [ClubController::class, 'approval'])->name('club.approval');
Route::post('/member/create', [MemberController::class, 'create'])->name('member.create');


