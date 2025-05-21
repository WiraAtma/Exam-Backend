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
        $search = $request->search;
        $list = $request->list;

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
        $authors = Book::select('author_id')
            ->selectRaw('SUM(rating_voter) as total_rating_voters')
            ->groupBy('author_id')
            ->orderByDesc('total_rating_voters')
            ->with('author')
            ->limit(10)
            ->get();
        
        return view('/author/index', ['authors' => $authors]);
    }

    public function formRating() {
        $authors = Author::has('books')->orderBy('name', 'asc')->get();

        return view('/form-rating/index', compact('authors'));
    }

    public function getBooksByAuthor($authorId) {
        $books = Book::where('author_id', $authorId)->orderBy('title', 'asc')->get(['id', 'title']);

        return $books;
    }

    public function store() {
        Rating::create([
            'book_id' => request('book_id'),
            'rating' => request('rating')
        ]);

        $bookId = request('book_id');

        $average = Rating::where('book_id', $bookId)->avg('rating');
        $voterCount = Rating::where('book_id', $bookId)->count();

        Book::where('id', $bookId)->update([
            'average_rating' => $average,
            'rating_voter' => $voterCount
        ]);

        return redirect('/')->with('success', 'Rating added successfully');
    }
}
