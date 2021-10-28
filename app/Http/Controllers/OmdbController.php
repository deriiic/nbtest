<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OmdbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $url = "http://www.omdbapi.com/";

        // Check for page number
        // Make 1 as default value
        $page = $request->page ?? 1;

        $feed = Http::get($url,
            [
                "apikey" => "209329ef",
                "s" => $request->title,
                "type" => $request->type,
                "page" => $page
            ])->json();

        // Check if query returns any feeds
        if(!isset($feed['Search'])) {
            return redirect()
                ->route('home')
                ->with('error', 'Could not find any title with that query.');
        }

        // Collect feeds from query
        $shows = collect($feed['Search']);

        // Make simple custom pagination
        // Get max pages
        $maxPages = (int) ceil($feed['totalResults'] / 10);

        // Get next page
        if ($page < $maxPages) {
            $nextPage = $page + 1;
        } else {
            $nextPage = null;
        }

        // Get previous page
        if ($page > 1) {
            $previousPage = $page - 1;
        } else {
            $previousPage = null;
        }
        // ---- End pagination ----

        // Get all movies stored as favorites
        $movies = Movie::where('user_id', Auth::id())->get();

        // For testing response
        // dd($movies);

        return view('omdb.index',[
            'shows' => $shows,
            'nextPage' => $nextPage,
            'page' => $page,
            'previousPage' => $previousPage,
            'movies' => $movies
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = "http://www.omdbapi.com/";

        $data = Http::get($url,
            [
                "apikey" => "209329ef",
                "i" => $id,
                "plot" => "short",
            ])->json();

        // For testing response
        //dd($data);

        // Get all favorite data
        $movies = Movie::where('user_id', Auth::id())->get();

        return view('omdb.show',[ 'data' => $data, 'movies' => $movies]);
    }
}
