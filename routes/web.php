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


Route::get('/', 'InicioController@index');

Route::get('/post/{id}', 'InicioController@post');



Route::get('/post/{idComent}/cDelete', 'InicioController@deleteComent');

Route::get('/cuenta/blog/create', 'PostsController@create');

Route::post('/cuenta/blog/create', 'PostsController@store');

Route::get('/cuenta/blog/{id}/edit', 'PostsController@edit');
Route::patch('/cuenta/blog/{id}/edit', 'PostsController@update');

Route::get('/cuenta/blog/{id}/delete', 'PostsController@destroy');


Route::get('/home', function () {
    return Redirect::intended('/cuenta');
});

Route::middleware([ 'auth' ])->group(function(){

    Route::get('route', 'example@action');

});

*/
Route::get('/', 'PostController@index');



Route::middleware([ 'auth' ])->group(function(){
Route::resource('posts', 'PostController')->except([
        'index','show'
]);

Route::resource("posts.comments", "CommentController");
Route::resource("posts.comments.likes", "LikeController");
});

Auth::routes();
Route::get('/account', 'HomeController@index')->name('account');
Route::get('/home', function () {
    return Redirect::intended('/account');
});

Route::get('/posts/{id}', 'PostController@show')->name('posts.show');