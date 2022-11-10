@extends('admin_panel.layouts.app')
@section('page_title')
    Quotes - add
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <form action="{{ route("admin-panel.quotes.store", ["locale" => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="form-group col-6">
                            <label for="">@lang('admin_panel/movies.movie')</label>
                            <select class="form-control" name="movie_id">
                                <option selected disabled value="">@lang('admin_panel/action.select')</option>
                                @foreach ($movies as $movie)
                                    <option value="{{ $movie->id }}">
                                        {{ json_decode($movie->movie_details, true)[app()->getLocale()]["movie_title"] ?? ""  }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="image">@lang('admin_panel/quotes.image')</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                    @foreach($langs as $key => $lang)
                        <div class="row mb-2">
                            <div class="form-group col-6">
                                <label for="text_{{$key}}">@lang('admin_panel/quotes.quote.text') {{ $key }} </label>
                                <input type="text" class="form-control" name="lang[{{$key}}][text]" id="text_{{$key}}" placeholder="@lang('admin_panel/quotes.enter.quote')">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">@lang('admin_panel/action.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session()->has('message'))
    <script>
        $(document).ready(function() {
            toastr.success("{{ session()->get('message') }}");
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        $(document).ready(function() {
            toastr.error("{{ session()->get('error') }}");
        });
    </script>
@endif

@if ($errors->any())
    <script>
        $(document).ready(function() {
            toastr.error("{{ session()->get('errors')->first() }}");
        });
    </script>
@endif

@endsection
