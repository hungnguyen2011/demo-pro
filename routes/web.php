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


Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
	Route::get('/', 'HomeController@index')->name('recomend');

	Route::get('login', 'HomeController@showLogin')->name('login-form');
	Route::post('login', 'HomeController@Login')->name('login');

	Route::get('sign-up', 'HomeController@showSignUp')->name('sign-up-form');
	Route::post('sign-up', 'HomeController@signUp')->name('sign-up');

	Route::get('introduce', 'HomeController@introduce')->name('introduce');

	Route::group(['middleware'=>'userLogin'], function () {

		Route::post('logout', 'HomeController@Logout')->name('logout');

		Route::get('infor/{id}', 'HomeController@showInfor')->name('infor');
		
		Route::get('test', 'ExamController@test')->name('test');
		Route::get('detail-test/{id}', 'ExamController@showDetailTest')->name('detail-test');
		Route::get('start-test/{id}', 'ExamController@startTest')->name('start-test');
		Route::post('start-test/{id}', 'ExamController@postTest')->name('test-exam');
	});
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

	Route::get('login', 'HomeAdminController@showLogin')->name('login-form');
	Route::post('login', 'HomeAdminController@Login')->name('login');
	Route::group(['middleware'=>'adminLogin'], function () {
		Route::post('logout', 'HomeAdminController@Logout')->name('logout');
		Route::get('/', 'HomeAdminController@index')->name('list');

		Route::get('add-user', 'HomeAdminController@add')->name('add-user');
		Route::post('add-user', 'HomeAdminController@addUser')->name('add-user');
		Route::post('validate_unique_mail', 'HomeAdminController@checkExistedMail')->name('user-mail');

		Route::get('edit-user/{id}', 'HomeAdminController@edit')->name('edit-user');
		Route::post('edit-user/{id}', 'HomeAdminController@editUser')->name('edit-user');

		Route::get('delete-user/{id}', 'HomeAdminController@deleteUser')->name('delete-user');
		
		Route::group(['prefix' => 'subject', 'as' => 'subject.'], function () {
			Route::get('subject', 'SubjectAdminController@index')->name('list');

			Route::get('add-subject', 'SubjectAdminController@add')->name('add-subject');
			Route::post('add-subject', 'SubjectAdminController@addSubject')->name('add-subject');

			Route::get('edit-subject/{id}', 'SubjectAdminController@edit')->name('edit-subject');
			Route::post('edit-subject/{id}', 'SubjectAdminController@editSubject')->name('edit-subject');

			Route::get('delete-subject/{id}', 'SubjectAdminController@deleteSubject')->name('delete-subject');

			Route::post('validate_unique_subject', 'SubjectAdminController@checkSubject')->name('subject');
		});

		Route::group(['prefix' => 'exam', 'as' => 'exam.'], function () {
			Route::get('index', 'ExamAdminController@index')->name('index');

			Route::get('subject/{id}', 'ExamAdminController@showListExam')->name('list-exam');

			Route::get('{id}/add-exam', 'ExamAdminController@add')->name('add-exam');
			Route::post('{id}/add-exam', 'ExamAdminController@addExam')->name('add-exam');

			Route::get('{id}/edit-exam/{id1}', 'ExamAdminController@edit')->name('edit-exam');
			Route::post('{id}/edit-exam/{id1}', 'ExamAdminController@editExam')->name('edit-exam');

			Route::get('delete-exam/{id}', 'ExamAdminController@deleteExam')->name('delete-exam');

			Route::get('{id}/question', 'ExamAdminController@showListQuestion')->name('list-question');

			Route::get('{id}/add-question', 'ExamAdminController@addQues')->name('add-question');
			Route::post('{id}/add-question', 'ExamAdminController@addQuestion')->name('add-question');

			Route::get('edit-question/{id}', 'ExamAdminController@editQues')->name('edit-question');
			Route::post('edit-question/{id}', 'ExamAdminController@editQuestion')->name('edit-question');

			Route::get('delete-question/{id}', 'ExamAdminController@deleteQuestion')->name('delete-question');

		});
	});
});