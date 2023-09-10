<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
	protected $table = 'movie';
    protected $fillable = ['title', 'description', 'rating'];

    public function updateMovie($param) {
    	DB::beginTransaction();

    	try {
    		$movie = DB::table('movie')->where('id',$param['id'])->update($param['data']);
    		DB::commit();

	    	return $movie;
    	} catch (Exception $e) {
    		DB::rollback();

    		return [
    			"status" => false,
    			"message" => "Update movie failed."
    		];
    	}
    }

    public function deleteMovie($id) {
    	DB::beginTransaction();

    	try {
    		DB::table('movie')->where('id', $id)->delete();

	    	DB::commit();

	    	return [
    			"status" => true,
    			"message" => "Delete movie from database."
    		];
    	} catch (Exception $e) {
    		DB::rollback();

    		return [
    			"status" => false,
    			"message" => "Delete movie failed."
    		];
    	}
    }
}
