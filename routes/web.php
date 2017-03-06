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

#  route to get /book/{title?} without Controller
/*Route::get('/book/{title?}', function($title = '') {

    if($title == '') {
        return 'Your request did not include a title.';
    }
    else {
        return 'Results for the book: '.$title;
    }

});*/


#  route to test current environment without Controller
/*Route::get('/example', function () {
   return App::environment();
});*/

/*route to get welcome file without Controller
Route::get('/', function () {
    return view('welcome');
});*/

# New route to get all Books via BookController index method
Route::get('/books', 'BookController@index');
# New route get Books via title using BookController view method
Route::get('/books/{title?}', 'BookController@view');
# New route get welcome file using WelcomeController invoke method
Route::get('/', 'WelcomeController');