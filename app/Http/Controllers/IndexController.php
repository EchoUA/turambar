<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Movies;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movies::where(['isActive' => true])->get();

        return view('index.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('index.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MovieRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        Movies::create($request->all());

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function show(Movies $movies)
    {
        $movies = $movies->toArray();

        return view('index.show', compact('movies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function edit(Movies $movies)
    {
        return view('index.edit', compact('movies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Movies $movies
     * @param MovieRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Movies $movies, MovieRequest $request)
    {
        $movies->update($request->all());

        return redirect()->route('movie.show', [$movies->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movies $movies)
    {
        $movies->delete();

        return redirect('/');
    }


    public function second()
    {
        $array = range(0, 10);
        shuffle($array);

        return view('index.second', compact('array'));
    }
}
