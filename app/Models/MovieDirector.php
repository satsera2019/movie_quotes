<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Validator;

class MovieDirector extends Model
{
    use HasFactory;

    
    protected $fillable = [
        "user_id",
        "name",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getActiveMovieDirector()
    {
        return self::whereNull("deleted_at")->get();
    }


    
    public static function validateMovieDirector($request)
    {
        $langs = config()->get('lang');
        foreach ($langs as $lang => $value){
            $validator = Validator::make($request[$lang], [
                "name" => "required|string",
            ]);
    
            if ($validator->fails()) {
                return ["error" => true, "message" => $validator->messages()->first()];
            }
        }
        return ["error" => false];
    }


    public static function createMovieDirector($request)
    {
        self::create([
            "user_id" => auth()->user()->id,
            "name" => json_encode($request),
        ]);
        return true;
    }
    
}
