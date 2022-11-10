@extends('admin_panel.layouts.app')
@section('page_title')
    Movies - edit
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <form action="{{ route("admin-panel.movies.store", ["locale" => app()->getLocale()]) }}" method="POST">
                @csrf
                <div class="card-body">
                    {{-- {{ dd($request, $request["id"], $request["movie_details"]) }} --}}
                    @foreach($langs as $key => $lang)
                        <div class="row mb-2">
                            <div class="form-group col-6">
                                <label for="movie_title_{{$key}}">@lang('admin_panel/movies.movie.title') {{ $key }} </label>
                                <input type="text" class="form-control" name="{{$key}}[movie_title]" id="movie_title_{{$key}}" placeholder="Enter Movie Title">
                            </div>
                            <hr/>
                            <div class="form-group col-6">
                                <label for="movie_director_{{$key}}">@lang('admin_panel/movies.movie.director') {{ $key }}</label>
                                <input type="text" class="form-control" name="{{$key}}[movie_director]" id="movie_director_{{$key}}"  placeholder="Enter movie director">
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
