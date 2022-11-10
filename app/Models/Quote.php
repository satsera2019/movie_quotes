<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        "movie_id",
        "user_id",
        "text",
        "image",
    ];

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
        // dd("validateMovies", $request, $request["movie_id"]);

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

    public static function storeImage($request)
    {
        $image_validator = Validator::make($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,svg'
        ]);
        if ($image_validator->fails()) {
            return ["error" => true, "message" => $image_validator->messages()->first()];
        }
        $imageName = time().'.'.$request["image"]->extension();
        $uploaded = $request["image"]->move(public_path('assets/images/quotes'), $imageName);
        // $uploaded = $request["image"]->storeAs('images/quotes', $imageName);
        if($uploaded){
            return ['error' => false, "message" => 'Image uploaded Successfully!', 'image' => $imageName];
        }
        return false;
    }

    
    public static function getRandomQuote(int $count)
    {
        return self::whereNull("deleted_at")->get()->random($count);
    }
}
