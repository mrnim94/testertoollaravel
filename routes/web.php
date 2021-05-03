<?php

use Illuminate\Support\Facades\Route;

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

//BackEnd
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/add-jobs-testing','TestingController@add_jobs_testing');
Route::get('/add-user-for-job-testing','TestingController@add_user_for_job_testing');
Route::get('/add-github-for-job-testing','TestingController@add_github_for_job_testing');
Route::get('/show-jobs-testing','TestingController@show_jobs_testing');
Route::post('/run-jobs-testing','TestingController@run_jobs_testing');
Route::get('/show-runs-jobs/{job_id}','TestingController@show_runs_jobs');
Route::get('/show-runs-jobs/{job_id}/{alert_telegram}/{time_range}','TestingController@show_runs_jobs' );
Route::get('/show-run-test/{test_id}','TestingController@show_run_test' );
Route::post('/save-job-testing','TestingController@save_job_testing');
Route::post('/save-user-job-testing','TestingController@save_user_job_testing');
Route::post('/save-github-job-testing','TestingController@save_github_job_testing');
Route::get('/delete-runs-jobs/{job_id}','TestingController@delete_runs_jobs');
Route::post('/upate-alert-telegram-job','TestingController@upate_alert_telegram_job');


//Schedule
Route::get('/add-schedule','ScheduleController@add_schedule');
Route::post('/save-schedule','ScheduleController@save_schedule');
Route::get('/list-schedules','ScheduleController@list_schedules');
Route::post('/delete-schedules','ScheduleController@delete_schedules');

//Alert

Route::get('/list-alert-telegram','AlertController@list_alert_telegram');
Route::get('/add-alert-telegram','AlertController@add_alert_telegram');
Route::post('/save-alert-telegram','AlertController@save_alert_telegram');
Route::post('/delete-alert-telegram','AlertController@delete_alert_telegram');



