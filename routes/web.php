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

Route::get('/',function(){
    return redirect('/login');
});
Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home','HomeController@index');
    Route::get('/',function(){
        return redirect('/home');
    });
    Route::resource('questions', 'QuestionController');
    Route::get('questions/add/{id}', [
        'as' => 'questions.add',
        'uses' => 'QuestionController@add'
    ]);
Route::resource('questionaire', 'QuestionaireController');



});
