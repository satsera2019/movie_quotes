@extends('admin_panel.layouts.app')
@section('page_title') @lang('admin_panel/quotes.quotes') - @lang('admin_panel/action.index') @endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-end m-2">
                <a class="btn btn-block btn-primary col-md-2 col-12" 
                    href="{{ route("admin-panel.quotes.create", ["locale" => app()->getLocale()]) }}">
                    @lang('admin_panel/quotes.add.quote')
                </a>    
            </div>  
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('admin_panel/action.user')</th>
                                <th>@lang('admin_panel/movies.movie.title')</th>
                                <th>@lang('admin_panel/movies.movie.director')</th>
                                <th>@lang('admin_panel/quotes.quote')</th>
                                <th>@lang('admin_panel/quotes.image')</th>
                                <th>@lang('admin_panel/action.created.at')</th>
                                <th>@lang('admin_panel/action.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($quotes) > 0)
                                @foreach($quotes as $quote)
                                    <tr>
                                        <td>{{ $quote->user->id}}</td>
                                        <td>{{ $quote->user->email ?? "-" }}</td>
                                        <td>
                                            @if ($quote->movie)
                                                {{ json_decode($quote->movie->movie_details, true)[app()->getLocale()]["movie_title"] ?? "-"  }}    
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($quote->movie && $quote->movie->director)
                                                {{ json_decode($quote->movie->director["name"], true)[app()->getLocale()]["name"] ?? "-"  }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            {{ json_decode($quote->text, true)[app()->getLocale()]["text"] ?? "-" }}
                                        </td>
                                        <td>
                                            <a href="{{ asset("assets/images/quotes").$quote->image }}" target="_blank">
                                                <img src="{{ asset("assets/images/quotes").$quote->image }}" width="50" alt="image">
                                            </a>
                                        </td>
                                        <td>{{ $quote->created_at ?? "-" }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ route("admin-panel.quotes.edit",  [app()->getLocale(), $quote ]) }}" class="btn btn-info">
                                                        <i class="fa fa-edit"></i>@lang('admin_panel/action.edit')
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete_{{ $quote->id }}">
                                                        <i class="fa fa-trash"></i>@lang('admin_panel/action.delete')
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-delete_{{ $quote->id }}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{ json_decode($quote->text, true)[app()->getLocale()]["text"] ?? "" }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    @lang("admin_panel/action.confirm.delete") 
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin_panel/action.no')</button>
                                                    <form action="{{ route("admin-panel.quotes.delete", [app()->getLocale(), $quote]) }}" method="post">
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
