@extends('user_panel.layouts.app')

@section('content')
    @if (count($top_movie) === 0)
        <div class="row h3 justify-content-center pt-5">
            @lang("user_panel/main.no.data.found")
        </div>
    @else
        <div class="row justify-content-center mt-5">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">@lang("admin_panel/movies.movie.director")</th>
                            <th scope="col">@lang("admin_panel/quotes.quote")</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($top_movie as $key => $quote)
                            <tr>
                                <td>
                                    @if($quote[0]->movie && $quote[0]->movie->director)
                                        {{ json_decode($quote[0]->movie->director["name"], true)[app()->getLocale()]["name"] ?? "" }}
                                    @else 
                                        -
                                    @endif
                                </td>
                                <td>
                                    @foreach ($quote as $item)
                                        <div scope="row">
                                            {{ json_decode($item->text, true)[app()->getLocale()]["text"] ?? "" }}
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection