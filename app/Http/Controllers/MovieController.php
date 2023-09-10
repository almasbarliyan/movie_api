<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
     
        return response()->json($movies);
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
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'title' => 'required',
            'rating' => 'required'
        ]);
    
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
    
        $movies = Movie::create($input);
 
        return response()->json($movies);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movies = Movie::find($id);
   
        if (is_null($movies)) {
            return $this->sendError('Movie not found.');
        }
         
        return response()->json($movies);
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
        $param['id'] = $id;
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'title' => 'required',
            'rating' => 'required'
        ]);
    
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
    
        $param['data'] = [
            'title' => $input['title'],
            'description' => $input['description'],
            'rating' => $input['rating'],
            'image' => $input['image']
        ];

        $movie = new Movie();
        $movies = $movie->updateMovie($param);
    
        return response()->json($movies);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = new Movie();
        $movies = $movie->deleteMovie($id);
    
        return response()->json($movies);
    }
}
