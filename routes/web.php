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

Route::get('/index','BlogController@index')->name('blog_index');
Route::get('/show/{id}','BlogController@show')->name('blog_show');
Route::get('/category/{id}','BlogController@category')->name('blog_category');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('blog/blog/index','BackendController@index')->name('admin_blog_index');
Route::get('blog/blog/create','BackendController@create')->name('admin_blog_create');
Route::post('blog/blog/store','BackendController@store')->name('admin_blog_store');
Route::get('blog/blog/{blog}/edit','BackendController@edit')->name('admin_blog_edit');
Route::put('blog/blog/{blog}/update','BackendController@update')->name('admin_blog_update');
Route::delete('blog/blog/{blog}/delete','BackendController@destroy')->name('admin_blog_delete');
Route::put('blog/blog/{blog}/restore','BackendController@restore')->name('admin_blog_restore');
Route::delete('blog/blog/{blog}/force-destroy','BackendController@forceDestroy')->name('admin_blog_force-destroy');


Route::get('/blog/category/index','CategoryController@index')->name('admin_category_index');
Route::get('/blog/category/create','CategoryController@create')->name('admin_category_create');
Route::post('/blog/category/store','CategoryController@store')->name('admin_category_store');
Route::get('/blog/category/{id}/edit','CategoryController@edit')->name('admin_category_edit');
Route::put('/blog/category/{id}/update','CategoryController@update')->name('admin_category_update');
Route::delete('/blog/category/{id}/delete','CategoryController@destroy')->name('admin_category_delete');

Route::get('/blog/users/index','UserController@index')->name('admin_users_index');
Route::get('/blog/users/create','UserController@create')->name('admin_users_create');
Route::post('/blog/users/store','UserController@store')->name('admin_users_store');
Route::get('/blog/users/{id}/edit','UserController@edit')->name('admin_users_edit');
Route::put('/blog/users/{id}/update','UserController@update')->name('admin_users_update');
Route::delete('/blog/users/{id}/delete','UserController@destroy')->name('admin_users_delete');
Route::get('/blog/users/{id}/delete','UserController@confirm')->name('admin_users_confirm');