<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Validator;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "movie_director_id",
        "movie_details",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function director(): BelongsTo
    {
        return $this->belongsTo(MovieDirector::class, "movie_director_id");
    }

    public static function validateMovies($request)
    {
        $validator = Validator::make($request, [
            "movie_director_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return ["error" => true, "message" => $validator->messages()->first()];
        }

        $langs = config()->get('lang');
        foreach ($langs as $lang => $value){
            $validator = Validator::make($request[$lang], [
                "movie_title" => "required|string",
            ]);
    
            if ($validator->fails()) {
                return ["error" => true, "message" => $validator->messages()->first()];
            }
        }
        return ["error" => false];
    }

    public static function createMovie($request)
    {
        Movie::create([
            "user_id" => auth()->user()->id,
            "movie_director_id" => $request["movie_director_id"],
            "movie_details" => json_encode($request),
        ]);
        return true;
    }

    public static function getActiveMovies()
    {
        return self::whereNull("deleted_at")->get();
    }
}
