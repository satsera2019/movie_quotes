@extends('admin_panel.layouts.app')

@section('auth.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    {{ env("APP_NAME") }}
                    <div class="float-right">
                        @foreach(Config::get('lang') as $key => $lang)
                            <a href="{{ route("change-lang", ["locale" => $key]) }}" 
                                class="@if(app()->getLocale() === $key) disabled @endif btn btn-primary active ml-2" 
                                data-check-group="1">{{ $key }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route("admin-panel.login", ["locale" => app()->getLocale()]) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('auth.email.address') }}</label>
                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('auth.password') }}</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.log.in') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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