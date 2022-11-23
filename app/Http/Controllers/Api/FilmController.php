<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class FilmController extends Controller
{
    private $apiKey = 'bd966b35';
    private $baseUrl = 'http://www.omdbapi.com/?';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $response = Http::get('http://www.omdbapi.com/?apikey=bd966b35&t=blade');
        // $jsonData = $response->json();
        // $success = true;
        $json = json_decode(file_get_contents('http://www.omdbapi.com/?apikey=bd966b35'), true);
        return response()->json(compact('json'));
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
     * @param $title
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        $string = "{$this->baseUrl}apikey={$this->apiKey}&s={$title}";
        $json = json_decode(file_get_contents($string), true);
        return response()->json(compact('json'));
    }

    public function showId($id)
    {
        $string = "{$this->baseUrl}apikey={$this->apiKey}&i={$id}";
        $json = json_decode(file_get_contents($string), true);
        return response()->json(compact('json'));
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
