<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class Quote extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "movie_id",
        "user_id",
        "text",
        "image",
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

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public static function validateQuote($request)
    {
        $validator = Validator::make($request, [
            "movie_id" => "required|string",
        ]);
        if ($validator->fails()) {
            return ["error" => true, "message" => $validator->messages()->first()];
        }
        $langs = config()->get('lang');
        foreach ($langs as $lang => $value){
            $text_validator = Validator::make($request["lang"][$lang], [
                "text" => "required|string",
            ]);
            if ($text_validator->fails()) {
                return ["error" => true, "message" => $text_validator->messages()->first()];
            }
        }
        return ["error" => false];
    }

    public static function createQuote($request)
    {
        $image_uploaded = self::storeImage($request);
        if(isset($image_uploaded["error"]) && $image_uploaded["error"] === false){
            Quote::create([
                "user_id" => auth()->user()->id,
                "movie_id" => $request["movie_id"],
                "text" => json_encode($request["lang"]),
                "image" => "/" . $image_uploaded["image"],
            ]);    
            return true;
        }
        return false;
    }

    public static function updateQuote(Quote $quote, array $request)
    {
        if(isset($request["image"]) || array_key_exists('image', $request)){
            $image_uploaded = self::storeImage($request);
            $quote->update([
                "image" => "/" . $image_uploaded["image"],
            ]);
        }
        $quote->update([
            "user_id" => auth()->user()->id,
            "movie_id" => $request["movie_id"],
            "text" => json_encode($request["lang"]),
        ]);    
        return true;
    }

    public static function storeImage($request)
    {
        $image_validator = Validator::make($request, ['image' => 'required|image|mimes:jpeg,png,jpg,svg']);
        if ($image_validator->fails()) {return ["error" => true, "message" => $image_validator->messages()->first()];}
        $imageName = time().'.'.$request["image"]->extension();
        $uploaded = $request["image"]->move(public_path('assets/images/quotes'), $imageName);
        if($uploaded){return ['error' => false, "message" => 'Image uploaded Successfully!', 'image' => $imageName];}
        return false;
    }

    public static function getTopMovieDirectors(int $count)
    {
        return Quote::selectRaw('*')->joinSub(Quote::selectRaw('movie_id, count(*) total_count')->groupBy('movie_id')->limit($count), 'q', 
            function ($join) { $join->on('q.movie_id', '=', 'quotes.movie_id');}
        )->get()->groupBy('movie_id');
    }
}
