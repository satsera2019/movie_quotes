@extends('user_panel.layouts.app')

@section('content')
    @if (empty($random_quote))
        <div class="row h3 justify-content-center pt-5">
            @lang("user_panel/main.no.data.found")
        </div>
    @else
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="false" ride="false">
            <div class="carousel-inner">
                <div class="carousel-item active w-50 ml-auto mr-auto">
                    <img class="d-block w-100" src="{{ asset("assets/images/quotes").$random_quote->image }}" alt="image">
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center h3 mt-2">
                    "{{ json_decode($random_quote->text, true)[app()->getLocale()]["text"] ?? "" }}"
                </div>

                <div class="col-12 text-center h3 mt-2">
                    <a target="_blank" href="{{ route("home.movie", ["locale" => app()->getLocale(), "movie" => $random_quote->movie->id]) }}">
                        {{ json_decode($random_quote->movie["movie_details"], true)[app()->getLocale()]["movie_title"] ?? "" }}
                    </a>
                </div>

                <div class="col-12 text-center h3 mt-2">
                    @if($random_quote->movie->director)
                        {{ json_decode($random_quote->movie->director["name"], true)[app()->getLocale()]["name"] ?? "" }}
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection
