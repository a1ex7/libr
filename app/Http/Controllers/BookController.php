<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;

use App\Book;
use App\User;

class BookController extends Controller
{
    /**
     * Display a listing of the Books.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::paginate(10);

        return view('book/index', ['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('book/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $rules = array(
            'title' => 'required',
            'author' => 'required|alpha',
            'year' => 'required|numeric',
            'genre' => 'required|alpha',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('books/create')
                ->withErrors($validator)
                ->withInput();
        }
        else {

            $book = new Book();

            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;

            $book->save();

            Session::flash('message', 'New book successfully created');

            return Redirect::to('books');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('book/show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book/edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'title' => 'required',
            'author' => 'required|alpha',
            'year' => 'required|numeric',
            'genre' => 'required|alpha',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('books/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }
        else {

            $book = Book::find($id);

            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;

            $book->save();

            Session::flash('message', 'New book successfully updated');

            return Redirect::to('books');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        Session::flash('message', 'Deleted Book with ID: ' . $id);

        return Redirect::to('books');
    }

    /**
     * Display a listing of the Books for User with ID.
     *
     * @return Response
     */
    public function usersBooks($id)
    {
        $books = User::find($id)->books()->get();

        return view('book/usersBooks', ['books'=>$books, 'user_id' =>$id]);
    }

    public function returnBook($uid, $bid)
    {
        $returned = DB::table('users_books')->where('user_id', $uid)->where('book_id', $bid);
        $returned->delete();

        Session::flash(
            'message', 'Returned book with ID: ' . $bid . ' from user with ID: ' . $uid
        );

        return Redirect::to('users/' . $uid . '/books');
    }

    /**
     * Display a listing of the Books witch adding to user with id.
     *
     * @return Response
     */
    public function listAddingBook($user_id)
    {
        $books = Book::paginate(10);

        return view('book/index', ['books'=>$books, 'user_id'=>$user_id]);
    }

    public function addBook($uid, $bid)
    {
        DB::table('users_books')->insert(
            ['user_id' => $uid, 'book_id' => $bid]
        );


        Session::flash(
            'message', 'Book with ID: ' . $bid . ' successfully add to user with ID: ' . $uid
        );

        return Redirect::to('books/users/' . $uid);
    }
}
