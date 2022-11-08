@extends('admin_panel.layouts.app')
@section('page_title')
    Movies - index
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Movie director</th>
                                <th>Movie Title</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($movies) > 0)
                                @foreach($movies as $movie)
                                    <tr>
                                        <td>{{ $movie->user->first_name ?? "" }} {{ $movie->user->last_name ?? "" }}</td>
                                        <td>{{ $movie->movie_director ?? "" }}</td>
                                        <td>{{ $movie->movie_title ?? "" }}</td>
                                        <td>{{ $movie->created_at ?? "" }}</td>
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
@endsection
