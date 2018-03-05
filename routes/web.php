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

Route::group(['middleware' => ['s2gis']], function () {
    Route::get('/', function () {
        return view('pages.main_menu');
    });

    Route::get('/home', function () {
        return view('pages.main_menu');
    });

    Route::get('/issues', "Main\MenuController@showIssues")->name("user.main_issue");
    Route::get('/create-issue', "Main\MenuController@showCreateIssues")->name("user.create_issue");
    Route::get('/view-issue', "Main\MenuController@showViewIssues")->name("user.view_issue");

    Route::get('/get-form-api', "User\IssueController@formAPI")->name("user.form_api");
    Route::post('/save-issue', "User\IssueController@save")->name("user.save_issue");
});

//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
