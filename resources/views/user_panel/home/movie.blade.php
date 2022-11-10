@extends('user_panel.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div>
            {{ json_decode($movie->director->name, true)[app()->getLocale()]["name"] ?? ""  }}
        </div>
        <div>
            {{ json_decode($movie->movie_details, true)[app()->getLocale()]["movie_title"] ?? ""  }}
        </div>
    </div>
@endsection