<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = Movie::where('user_id', Auth()->id())->paginate(5);

        $url = "http://www.omdbapi.com/";

        $feed = [];

        foreach ($titles as $title)
        {
            $feed[] = Http::get($url,
                [
                    "apikey" => "209329ef",
                    "i" => "$title->movie_id",
                ])->json();
        }

        // For testing response
        //dd($data);

        return view('movies.index', [
            "feed" => $feed,
            "titles" => $titles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie();

        $movie->user_id = Auth()->id();
        $movie->movie_id = $request->movie_id;

        $movie->save();

        return redirect()->back()->with('success', 'Added to favorites.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Movie::where('movie_id', $id)->where('user_id', Auth()->id())->delete();

        return redirect()->back()->with('success', 'Title deleted from favorites');
    }
}
