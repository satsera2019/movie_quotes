@extends('admin_panel.layouts.app')
@section('page_title')
    @lang('admin_panel/movies.movies') - @lang('admin_panel/action.index')
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            
            <div class="row justify-content-end m-2">
                <a class="btn btn-block btn-primary col-md-2 col-12" href="{{ route("admin-panel.movies.create", ["locale" => app()->getLocale()]) }}">
                    @lang('admin_panel/movies.add.movie')
                </a>    
            </div>  
            
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('admin_panel/action.user')</th>
                                <th>@lang('admin_panel/movies.movie.director')</th>
                                <th>@lang('admin_panel/movies.movie.title')</th>
                                <th>@lang('admin_panel/action.created.at')</th>
                                <th>@lang('admin_panel/action.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($movies) > 0)
                                @foreach($movies as $movie)
                                    <tr>
                                        <td>{{ $movie->id ?? "-" }}</td>
                                        <td>{{ $movie->user->email ?? "-" }}</td>
                                        <td>
                                            @if ($movie->director) 
                                                {{ json_decode($movie->director->name, true)[app()->getLocale()]["name"] ?? "-"  }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            {{ json_decode($movie->movie_details, true)[app()->getLocale()]["movie_title"] ?? "-"  }}
                                        </td>
                                        <td>{{ $movie->created_at ?? "-" }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ route("admin-panel.movies.edit",  [app()->getLocale(), $movie ]) }}" class="btn btn-info">
                                                        <i class="fa fa-edit"></i>@lang('admin_panel/action.edit')
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete_{{ $movie->id }}">
                                                        <i class="fa fa-trash"></i>@lang('admin_panel/action.delete')
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-delete_{{ $movie->id }}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{ json_decode($movie->movie_details, true)[app()->getLocale()]["movie_title"] ?? ""  }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">@lang("admin_panel/action.confirm.delete")</div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin_panel/action.no')</button>
                                                    <form action="{{ route("admin-panel.movies.delete", ["locale" => app()->getLocale(), "movie" => $movie]) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">@lang('admin_panel/action.yes')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <tr class="table__row">
                                    <td colspan="10" class="text-center py-5">@lang('user_panel/main.no.data.found')</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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
