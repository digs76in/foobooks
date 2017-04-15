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
//Route::get('/books/{title?}', 'BookController@view');
# New route get welcome file using WelcomeController invoke method
Route::get('/', 'WelcomeController');
# Temp Practice route
/*Route::get('/practice', function() {
    echo config('mail.driver');
});*/
Route::get('/books/{title}', 'BookController@show');

/**
* Practice controller route
*/
Route::any('/practice/{n?}', 'PracticeController@index');
/**
* Debugbar test route
*/
Route::get('/debugbar', function() {

    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::info('Current environment: '.App::environment());
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Just demoing some of the features of Debugbar';

});
/**
* LaravelLogViewer test route
*/

if(config('app.env')=='local'){
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}

Route::get('/debug', function() {

	echo '<pre>';

	echo '<h1>Environment</h1>';
	echo App::environment().'</h1>';

	echo '<h1>Debugging?</h1>';
	if(config('app.debug')) echo "Yes"; else echo "No";

	echo '<h1>Database Config</h1>';
    echo 'DB defaultStringLength: '.Illuminate\Database\Schema\Builder::$defaultStringLength;
    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
	//print_r(config('database.connections.mysql'));

	echo '<h1>Test Database Connection</h1>';
	try {
		$results = DB::select('SHOW DATABASES;');
		echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
		echo "<br><br>Your Databases:<br><br>";
		print_r($results);
	}
	catch (Exception $e) {
		echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
	}

	echo '</pre>';

});

if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database foobooks');
        DB::statement('CREATE database foobooks');

        return 'Dropped foobooks; created foobooks.';
    });

};