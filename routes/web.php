<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/jadwal', 'ScheduleController@index')->name('jadwal');

Route::resource('siswa', 'StudentController');
Route::resource('guru', 'TeacherController');
Route::resource('mapel', 'SubjectController');
Route::resource('siswa-mapel', 'StudentSubjectController');
Route::resource('guru-mapel', 'TeacherSubjectController');