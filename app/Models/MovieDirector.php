<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class MovieDirector extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $fillable = [
        "user_id",
        "name",
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

    
    public static function updateMovieDirector(MovieDirector $director, array $request)
    {
        $director->update([
            "user_id" => auth()->user()->id,
            "name" => json_encode($request),
        ]);
        return true;
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
