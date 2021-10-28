<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OmdbController extends Controller
{
    public function __construct()
    {
        $url = "http://www.omdbapi.com/?apikey=209329ef&";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $client = new Client();
        $title = $request->title;
        $type = $request->type;

        // Check for page number
        $page = $request->page ?? 1;

        $response = $client->request("GET", "http://www.omdbapi.com/",
            ["query" => ["apikey" => "209329ef", "s" => $title, "type" => $type, "page" => $page]]);

        $data = json_decode($response->getBody(), true);

        // Get max pages
        $maxPages = (int) ceil($data['totalResults'] / 10);

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


        //dd($data);

        return view('omdb.index')->with(compact('data', 'maxPages', 'page', 'nextPage', 'previousPage'));
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
        $client = new Client();

        $response = $client->request("GET", "http://www.omdbapi.com/",
            ["query" => ["apikey" => "209329ef", "i" => $id, "plot" => "short"]]);

        $data = json_decode($response->getBody(), true);

        //dd($data);

        return view('omdb.show')->with('data', $data);
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
