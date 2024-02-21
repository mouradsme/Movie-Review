<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $movies = DB::table('movies')
            ->join('genres', 'movies.genre', '=', 'genres.id')
            ->select('movies.*', 'genres.name as GenreName')
            ->get();

        $Movies = array();
        foreach ($movies as $movie) {
            $movie->rating = floor($movie->rating);
            $Movies[] = $movie;
        }
        return view('movies.index', array(
            'Movies' => $Movies
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $Genres = Genre::all();
        return view('movies.create', array(
            'Genres' => $Genres
        ));
    }

    public function review(Request $request, $id)
    {
        //
        $User = json_decode(Auth::user(), true);
        $Movie = Movie::find($id);
        $Review = DB::table('movie_reviews')->where('user_id', $User['id'])->where('movie_id', $id)
            ->get();
        $Review = count($Review) > 0 ? $Review[0] : null;
        $Reviews =  $movies = DB::table('movie_reviews')
        ->join('users', 'movie_reviews.user_id', '=', 'users.id')
        ->where('movie_reviews.movie_id', $id)
        ->select('movie_reviews.rating as Rating', 'movie_reviews.review as Review', 'users.*')
        ->get();

        return view('movies.review', array(
            'Movie' => $Movie,
            'Review' => $Review,
            'Reviews' => $Reviews
        ));
    }

    public function store_review(Request $request) {
        $Review = DB::table('movie_reviews')
            ->where('user_id', '=', $request->input('user_id'))
            ->where('movie_id', '=', $request->input('movie_id'))
            ->get();
        $Success = false;

        if (count($Review) > 0) {
            $updated = DB::table('movie_reviews')
                ->where('id', '=', $Review[0]->id)
                ->update([
                    'review' => $request->input('review'),
                    'rating' => $request->input('rating')
                ]);
            if ($updated) $Success = true;
        } else {
            $added =DB::table('movie_reviews')->insert([
                'user_id' => $request->input('user_id'),
                'movie_id' => $request->input('movie_id'),
                'review' => $request->input('review'),
                'rating' => $request->input('rating')
            ]);
            if ($added) $Success = true;
        }
        if ($Success) {
            $rating = DB::table('movie_reviews')->where('movie_id', '=', $request->input('movie_id'))->avg('rating');
            $Movie = Movie::find($request->input('movie_id'));
            $Movie->rating = $rating;
            $Movie->update();
            return redirect('/movies');

        }
        return redirect('/error');

    }

    public function delete(Request $request, $id) {
        Movie::find($id)->delete();
        return redirect('/movies');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $Movie = Movie::where('title', $request->input('movie_title'))->get();
        if (count($Movie) > 0) {
            return redirect('/error');
        } else {
            $Movie = Movie::create([
                'title' => $request->input('movie_title'),
                'description' => $request->input('description'),
                'cover' => $request->input('cover'),
                'genre' => $request->input('genre'),
                'link' => $request->input('link')
            ]);
            if ($Movie->exists) {
                return redirect('/movies');
            }
        }
        return redirect('/error');

    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
