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
        $page = $request->page ?? 1;

        $feed = Http::get($url,
            [
                "apikey" => "209329ef",
                "s" => $request->title,
                "type" => $request->type,
                "page" => $page
            ])->json();

        if(!isset($feed['Search'])) {
            return redirect()->route('home')->with('error', 'Could not find any title with that query.');
        }

        $shows = collect($feed['Search']);

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

        // Get all favorite data
        $movies = Movie::where('user_id', Auth::id())->get();

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

        //dd($data);

        // Get all favorite data
        $movies = Movie::where('user_id', Auth::id())->get();

        return view('omdb.show',[ 'data' => $data, 'movies' => $movies]);
    }
}
