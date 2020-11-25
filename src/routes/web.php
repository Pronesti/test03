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

Route::get('/', 'PostsController@index')->name('post.index');


Auth::routes();

Route::post('follow/{user}', 'FollowsController@store')->name('follow.store');
Route::post('comment/{post}', 'CommentsController@store')->name('comment.store');

Route::post('like/{post}', 'LikesController@store')->name('like.store');
Route::get('like/all', 'LikesController@index')->name('like.index');

Route::get('/profile/{user?}', 'ProfilesController@show')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}/update', 'ProfilesController@update')->name('profile.update');

Route::get('/p/create', 'PostsController@create')->name('post.create');
Route::post('/p/store', 'PostsController@store')->name('post.store');
Route::get('/p/{post}', 'PostsController@show')->name('post.show');
