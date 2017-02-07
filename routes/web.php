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

Route::get('/about', 'PagesController@getAbout');

Route::get('contact', 'PagesController@getContact');

Route::post('contact', 'PagesController@postContact');

/*Route::get('/', 'PagesController@getIndex');
*/
Route::get('/', ['uses' =>'PagesController@getIndex', 'as' => 'home']);

Route::get('blog/{slug}', ['as' => 'blog.single', 
	'uses' => 'BlogController@getSingle'])
	->where('slug', '[\w\d\-\_]+');

Route::get('blog', ['uses' =>'BlogController@getIndex', 'as' => 'blog.index']);

/*//Authentication routes
Route::get('auth/login', 'Auth\LoginController@showLoginForm');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');

//Registration Routes
Route::get('auth/register', 'Auth\RegisterController@getRegister');
Route::post('auth/register', 'Auth\RegisterController@postRegister');*/

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::resource('posts', 'PostController');

Route::resource('categories', 'CategoryController', ['except' =>['create']]);

Route::resource('tags', 'TagController', ['except' =>['create']]);

Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);

Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete' ]);


