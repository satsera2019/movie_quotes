@extends('user_panel.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 mb-4 text-center h3">
            {{ json_decode($movie->movie_details, true)[app()->getLocale()]["movie_title"] ?? ""  }}
        </div>

        @foreach ($movie->quotes as $quote)
            <div class="row col-12 justify-content-center mb-5">
                <img class="" src="{{ asset("assets/images/quotes").$quote->image }}" style="width: 400px">
                <span class="col-12 text-primary text-center">
                    {{ json_decode($quote->text, true)[app()->getLocale()]["text"] ?? "" }}
                </span>
            </div>
        @endforeach
    </div>
@endsection