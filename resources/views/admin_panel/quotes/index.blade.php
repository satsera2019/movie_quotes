@extends('admin_panel.layouts.app')
@section('page_title')
    Quotes - index
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
                                <th>Movie</th>
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
                                        <td>{{ $quote->movie->movie_title ?? "" }}</td>
                                        <td>{{ $quote->text ?? "" }}</td>
                                        <td>{{ $quote->icon ?? "" }}</td>
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
@endsection
