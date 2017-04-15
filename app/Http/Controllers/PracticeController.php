<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rych\Random\Random;
use App\Book;

class PracticeController extends Controller {


    /**
    *
    */
    public function practice3() {

        $random = new Random();

        // Generate a 16-byte string of random raw data
        $randomBytes = $random->getRandomBytes(16);
        dump($randomBytes);

        // Get a random integer between 1 and 100
        $randomNumber = $random->getRandomInteger(1, 100);
        dump($randomNumber);

        // Get a random 8-character string using the
        // character set A-Za-z0-9./
        $randomString = $random->getRandomString(8);
        dump($randomString);
    }
    
     public function practice6() {

       # Instantiate a new Book Model object
        $book = new Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = "Harry Potter and the Sorcerer's Stone";
        $book->author = 'J.K. Rowling';
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump('Added: '.$book->toArray());

    }
    
    public function practice5() {

        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->get();

        if($books->isEmpty()) {
            dump('No matches found');
        }
        else {
            foreach($books as $book) {
                dump($book->title);
            }
        }
    }
    
    public function practice4() {

        $book = new Book();
        $books = $book->all();

        dump($books->toArray());
       
    }

    /**
	*
	*/
    public function practice2() {

        dump(config('app'));
        

    }



    /**
	*
	*/
    public function practice1() {
        dump('This is the first example.');
        # Echo out what the mail => driver config is set to
        echo config('mail.driver');

        # Dump *all* of the mail configs
        dump(config('mail'));
    }

    public function practice7() {
        # Get only books published after 1950
        #   `where` is the constraint method
        #   `get` is the fetch method
       // $results = Book::where('published', '>', 1950)->get();
       // dump($results->toArray()); # Study the results

        
        # Get only books that were authored by F. Scott Fitzgerald
        # `where` is the constraint method
        # `get` is the fetch method
        //$results = Book::where('author', '=', 'F. Scott Fitzgerald')->get();
       // dump($results->toArray()); # Study the results
        
        # Get the *first* book in the table that was authored by F. Scott Fitzgerald
        # `where` & `orderBy` are the constraint methods
        # `first` is the fetch method
        //$results = Book::where('author', '=', 'F. Scott Fitzgerald')->orderBy('created_at')->first();
       // dump($results->toArray()); # Study the results  
        
        
        # Get only books that were published after 1950 *and* authored by F. Scott Fitzgerald
        # `where` is the constraint method, and it's used twice
        # `get` is the fetch method
       // $results = Book::where('published', '>', 1950)->where('author', '=', 'F. Scott Fitzgerald')->get();
        //dump($results->toArray()); # Study the results
        # Get all the books
        # There is no constraint method
        # `all` is the fetch method
        $results = Book::all();
        dump($results->toArray()); # Study the results
    }
    
    public function practice8() {

        # First get a book to update
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        if(!$book) {
            dump("Book not found, can't update.");
        }
        else {

            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }    
        

    }
    public function practice9() {
        # First get a book to delete
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        if(!$book) {
            dump('Did not delete- Book not found.');
        }
        else {
            $book->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }



    /**
	* ANY (GET/POST/PUT/DELETE)
    * /practice/{n?}
    *
    * This method accepts all requests to /practice/ and
    * invokes the appropriate method.
    *
    * http://foobooks.loc/practice/1 => Invokes practice1
    * http://foobooks.loc/practice/5 => Invokes practice5
    * http://foobooks.loc/practice/999 => Practice route [practice999] not defined
	*/
    public function index($n) {



        $method = 'practice'.$n;

        if(method_exists($this, $method))
            return $this->$method();
        else
            dd("Practice route [{$n}] not defined");

    }
}