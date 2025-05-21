<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index(Request $request) {
        // Retrieve books based on user input for pagination and search.
        $search = $request->input('search');
        $list = $request->input('list');

        $books = Book::with(['author', 'category'])
            ->where(function($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('author', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%' . $search . '%');
                    });
            })
            // average rating higher
            ->orderBy('average_rating', 'desc')
            ->paginate($list == '' ? 10 : $list);

        return view('/dashboard/index', ['books' => $books]);
    }

    public function topAuthor() {
        // Retrieve the top authors with the highest number of ratings above 5.
        $authors = Book::select('author_id')
            ->selectRaw('SUM(rating_voter) as total_rating_voters')
            ->groupBy('author_id')
            ->orderByDesc('total_rating_voters')
            ->with('author')
            ->take(10)
            ->get();
        
        return view('/author/index', ['authors' => $authors]);
    }

    public function formRating() {
        // show input form rating page with retrieving authors and book data
        $authors = Author::has('books')->orderBy('name', 'asc')->get();

        return view('/form-rating/index', compact('authors'));
    }

    public function getBooksByAuthor($authorId) {
        // retrieve books data based on the author selected. return books data
        $books = Book::where('author_id', $authorId)->orderBy('title', 'asc')->get(['id', 'title']);

        return $books;
    }

    public function store() {
        // Save a new rating record to the 'ratings' table
        Rating::create([
            'book_id' => request('book_id'),
            'rating' => request('rating')
        ]);

        // Get the book ID from the request
        $bookId = request('book_id');

        // Calculate the average rating for the book and Count the total number of voters for the book
        $average = Rating::where('book_id', $bookId)->avg('rating');
        $voterCount = Rating::where('book_id', $bookId)->count();

        // Update the books record with the new average rating and voter count
        Book::where('id', $bookId)->update([
            'average_rating' => $average,
            'rating_voter' => $voterCount
        ]);

        return redirect('/')->with('success', 'Rating added successfully');
    }
}
