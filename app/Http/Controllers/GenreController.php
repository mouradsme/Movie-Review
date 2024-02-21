<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    //

    public function index(Request $request) {

        $Genres = Genre::all();
        return view('genres.index')->with("Genres", $Genres);
    }

    public function create() {
        return view('genres.create');
    }

    public function store(Request $request) {
        $Genre = Genre::where('name', $request->input('genre_name'))->get();
        if (count($Genre) > 0) {
            return redirect('/error');
        } else {
            $Genre = Genre::create([
                'name' => $request->input('genre_name'),
                'description' => $request->input('description')
            ]);
            if ($Genre->exists) {
                return redirect('/genres');
            }
        }
        return redirect('/error');

    }

    public function delete(Request $request, $id) {
        Genre::find($id)->delete();
        return redirect('/genres');
    }
}
