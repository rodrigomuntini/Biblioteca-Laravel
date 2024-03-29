<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Index Method
     */
    public function index(Request $filter) {
        $filtering = $filter->get('desc_filter');

        if ($filtering == null)
            $authors = Author::orderBy('name')->paginate(5);
        else
            $authors = Author::where('name', 'ilike', '%'.$filtering.'%')
                                ->orderBy("name")
                                ->paginate(5)
                                ->setpath('authors?name=' . $filtering);

        return view('authors.index', ['authors' => $authors]);
    }

    /** 
     * Create Author Method
     */
    public function create() {
        return view('authors.create');
    }

    /**
     * Store Author Method
     * Stores a new author into the database
     */
    public function store(AuthorRequest $request) {
        Author::create($request->all());

        return redirect('authors');
    }

    /**
     * Delete Author Method
     */
    public function delete($id) {
        Author::find($id)->delete();

        return redirect('authors');
    }

    /**
     * Edit Author Method
     */
    public function edit($id) {
        $author = Author::find($id);

        return view('authors.edit', compact('author'));
    }

    /**
     * Update Author Method
     * Updates an author attributes
     */
    public function update(AuthorRequest $request, $id) {
        Author::find($id)->update($request->all());

        return redirect('authors');
    }
}
