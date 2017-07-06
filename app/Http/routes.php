<?php

Route::get('/', 'HomeController@index');
Route::post('home/getCalendar', 'HomeController@getCalendar');
Route::post('images/upload', 'HomeController@imageUpload');
Route::get('redirect', 'HomeController@redirect');

// Admin
Route::get('admin/tasks', 'AdminController@tasks');
Route::post('admin/tasks/apply', 'AdminController@tasksApply');
Route::post('admin/tasks/reject', 'AdminController@tasksReject');
Route::get('admin/users', 'AdminController@users');
Route::get('admin/users/remove', 'AdminController@remove');
Route::get('admin/users/purge', 'AdminController@purge');
Route::post('admin/users/email', 'AdminController@email');
Route::get('images/list', ['cat', 'uses' => 'AdminController@imagesList']);
Route::get('images/remove', 'AdminController@imageRemove');
Route::post('images/adm-upload', 'AdminController@imageAdmUpload');
Route::get('admin', 'AdminController@index');

// Staff
Route::get('staff/edit-{name}', ['name', 'uses' => 'StaffController@edit']);
Route::get('staff/edit', 'StaffController@editList');
Route::post('staff/save/{name}', ['name', 'uses' => 'StaffController@save']);
Route::post('staff/add-anecdot', 'StaffController@addAnecdot');
Route::post('staff/add-socopros', 'StaffController@addSocopros');
Route::post('staff/add-banner', 'StaffController@addBanner');

// Comments
Route::get('comment/{type}', ['type', 'uses' => 'CommentsController@index']);
Route::post('comment/remove', ['type', 'uses' => 'CommentsController@remove']);
Route::post('comment/{type}/post', ['type', 'uses' => 'CommentsController@post']);

// Info
Route::get('info/edit-{name}', ['name', 'uses' => 'InfoController@edit']);
Route::get('info/edit', 'InfoController@editList');
Route::post('info/save/{name}', ['name', 'uses' => 'InfoController@save']);
Route::get('info/{name}', ['name', 'uses' => 'InfoController@index']);

// Pins
Route::post('pins/post', 'PinsController@post');
Route::post('pins/remove', 'PinsController@remove');
Route::get('pins', 'PinsController@index');

// Adds
Route::post('adds/get', 'AddsController@get');
Route::post('adds/subscribe', 'AddsController@subscribe');
Route::post('adds/unsubscribe', 'AddsController@unsubscribe');
Route::post('adds/checksubscribe', 'AddsController@checkSubscribe');
Route::post('adds/getSubscribers', 'AddsController@getSubscribers');
Route::post('adds/removeSubscriber', 'AddsController@removeSubscriber');
Route::get('adds/remove/{id}', ['id', 'uses' => 'AddsController@remove']);
Route::get('adds/edit/{id}', ['id', 'uses' => 'AddsController@edit']);
Route::get('adds/single/{id}', ['id' => 'id', 'uses' => 'AddsController@single']);
Route::get('adds/add', 'AddsController@add');
Route::post('adds/post', 'AddsController@post');
Route::get('adds/{type}/{query}', ['type', 'query', 'uses' => 'AddsController@index']);
Route::get('adds', 'AddsController@index');

// News
Route::get('news/remove/{id}', ['id', 'uses' => 'NewsController@remove']);
Route::get('news/edit-{id}', ['id', 'uses' => 'NewsController@edit']);
Route::get('news/single/{id}', ['id' => 'id', 'uses' => 'NewsController@single']);
Route::get('news/add', 'NewsController@add');
Route::post('news/post', 'NewsController@post');
Route::get('news/{name}', ['name', 'uses' => 'NewsController@index']);
Route::get('news', 'NewsController@index');

// User
Route::get('cabinet', 'UserController@cabinet');
Route::get('user/activate/{hash}', ['hash', 'uses' => 'UserController@activate']);
Route::post('user/used', 'UserController@checkUsed');
Route::get('user/login', 'UserController@userLogin');
Route::post('user/save', 'UserController@save');
Route::get('user/{id}', ['id', 'uses' => 'UserController@inspect']);
Route::get('user', 'UserController@index');

// Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');