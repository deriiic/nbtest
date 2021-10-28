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
        $favorites = Movie::where('user_id', Auth::id())->get();

        //dd($shows);

        return view('omdb.index',[
            'shows' => $shows,
            'nextPage' => $nextPage,
            'page' => $page,
            'previousPage' => $previousPage,
            'favorites' => $favorites
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('omdb.show',[ 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
