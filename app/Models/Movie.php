<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id",
        "movie_director_id",
        "movie_details",
    ];

    protected static function booted()
    {
        static::addGlobalScope('deleted_at', function (Builder $builder) {
            $builder->where('deleted_at', null);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quote(): HasOne
    {
        return $this->hasOne(Quote::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
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

    public static function updateMovie(Movie $movie, array $request)
    {
        $movie->update([
            "user_id" => auth()->user()->id,
            "movie_director_id" => $request["movie_director_id"],
            "movie_details" => json_encode($request),
        ]);
        return true;
    }
}
