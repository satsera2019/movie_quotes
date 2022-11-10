@extends('admin_panel.layouts.app')
@section('page_title')
    Movies - add
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <form action="{{ route("admin-panel.movies.store", ["locale" => app()->getLocale()]) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group col-6">
                        <label for="">@lang('admin_panel/directors.director')</label>
                        <select class="form-control" name="movie_director_id">
                            <option selected disabled value="">@lang('admin_panel/action.select')</option>
                            @foreach ($movie_directors as $director)
                                <option value="{{ $director->id }}">
                                    {{ json_decode($director->name, true)[app()->getLocale()]["name"] ?? ""  }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @foreach($langs as $key => $lang)
                        <div class="row mb-2">
                            <div class="form-group col-6">
                                <label for="movie_title_{{$key}}">@lang('admin_panel/movies.movie.title') {{ $key }} </label>
                                <input type="text" class="form-control" name="{{$key}}[movie_title]" id="movie_title_{{$key}}" placeholder="Enter Movie Title">
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">@lang('admin_panel/movies.save')</button>
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
