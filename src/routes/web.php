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

Route::get('/', 'PostsController@index')->name('post.index')->middleware('auth');

Route::post('/bookmark/{post}', 'SaveController@store')->name('save.store')->middleware('auth');

Route::post('/follow/confirm/{profile}', 'FollowsController@update')->name('follow.update')->middleware('auth');
Route::post('/follow/delete/{profile}', 'FollowsController@destroy')->name('follow.destroy')->middleware('auth');

Route::post('/follow/{user}', 'FollowsController@store')->name('follow.store')->middleware('auth');

Route::post('/comment/{post}', 'CommentsController@store')->name('comment.store')->middleware('auth');

Route::post('/like/c/{comment}', 'CommentLikesController@store')->name('Postlike.store')->middleware('auth');
Route::post('/like/p/{post}', 'PostLikesController@store')->name('Postlike.store')->middleware('auth');

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit')->middleware('auth');
Route::patch('/profile/{user}/update', 'ProfilesController@update')->name('profile.update')->middleware('auth');

Route::get('/p/create', 'PostsController@create')->name('post.create')->middleware('auth');
Route::post('/p/store', 'PostsController@store')->name('post.store')->middleware('auth');
Route::get('/p/{post}', 'PostsController@show')->name('post.show');

Route::get('/stories/', 'StoriesController@index')->name('story.index')->middleware('auth');
Route::post('/story/store', 'StoriesController@store')->name('story.store')->middleware('auth');

Route::group(['prefix' => 'users'], function () {
    
    Auth::routes();
    
});

Route::get('/{username}/{category?}', 'ProfilesController@show')->name('profile.show');

