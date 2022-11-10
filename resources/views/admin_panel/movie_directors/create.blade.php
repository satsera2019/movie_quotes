@extends('admin_panel.layouts.app')
@section('page_title')
    Movie Directors - add
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <form action="{{ route("admin-panel.movie-directors.store", ["locale" => app()->getLocale()]) }}" method="POST">
                @csrf
                <div class="card-body">
                    @foreach($langs as $key => $lang)
                        <div class="row mb-2">
                            <div class="form-group col-6">
                                <label for="name_{{$key}}">@lang('admin_panel/directors.director.name') {{ $key }} </label>
                                <input type="text" class="form-control" name="{{$key}}[name]" id="name_{{$key}}" placeholder="@lang("admin_panel/directors.enter.director")">
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
