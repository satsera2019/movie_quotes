@extends('admin_panel.layouts.app')
@section('page_title')
    Quotes - index
@endsection
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
                                <th>User</th>
                                <th>Movie title</th>
                                <th>Movie director</th>
                                <th>Text</th>
                                <th>icon</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($quotes) > 0)
                                @foreach($quotes as $quote)
                                    <tr>
                                        <td>{{ $quote->user->email ?? "" }}</td>
                                        <td>
                                            {{ json_decode($quote->movie->movie_details, true)[app()->getLocale()]["movie_title"] ?? ""  }}
                                        </td>
                                        <td>
                                            {{ json_decode($quote->movie->movie_details, true)[app()->getLocale()]["movie_director"] ?? ""  }}
                                        </td>
                                        <td>
                                            {{ json_decode($quote->text, true)[app()->getLocale()]["text"] ?? "" }}
                                        </td>
                                        <td>
                                            <a href="{{ asset("assets/images/quotes").$quote->image }}" 
                                                target="_blank">
                                                <img src="{{ asset("assets/images/quotes").$quote->image }}" width="50" alt="image">
                                            </a>
                                        </td>
                                        <td>{{ $quote->created_at ?? "" }}</td>
                                        <td>
                                            <span class="tag tag-success">Approved</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table__row">
                                    <td colspan="10" class="text-center py-5">No data available in the table</td>
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
