@extends('admin_panel.layouts.app')
@section('page_title')
    Movies - index
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title">Responsive Hover Table</h3>--}}
{{--                </div>--}}

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
                            <tr>
                                <td>tes</td>
                                <td>John Doe</td>
                                <td>11-7-2014</td>
                                <td><span class="tag tag-success">Approved</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
