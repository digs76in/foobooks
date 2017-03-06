<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; # <- Add this

class BookController extends Controller {

    /**
    * GET /books
    */
    public function index() {
        #return App::environment(); # <- This is what we're testing out 
        return 'View all the books...';
    }
    /**
    * GET /books/{title?}
    */
     public function view($title=null) {
        return 'You want to view the book '.$title;
    }
}