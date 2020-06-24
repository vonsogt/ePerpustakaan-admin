<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = Book::where('title', 'LIKE', '%' . $search_term . '%')->paginate(10);
        } else {
            $results = Book::paginate(10);
        }

        return response()->json($results);
    }

    public function show($id)
    {
        return Book::find($id);
    }
}
