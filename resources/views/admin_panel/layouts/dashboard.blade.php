<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route("admin-panel.movies.index", ["locale" => app()->getLocale()]) }}" class="brand-link">
        {{ env("APP_NAME") }}
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ route("admin-panel.movie-directors.index", ["locale" => app()->getLocale()]) }}" 
                        class="nav-link @if(Request::segment(3) == 'movie-directors' || Request::segment(3) == '' ) active @endif ">
                        <i class="nav-icon fa fa-video"></i>
                        <p>@lang('admin_panel/movies.movie.directors')</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin-panel.movies.index", ["locale" => app()->getLocale()]) }}" 
                        class="nav-link @if(Request::segment(3) == 'movies') active @endif ">
                        <i class="nav-icon fa fa-film"></i>
                        <p>@lang('admin_panel/movies.movies')</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin-panel.quotes.index", ["locale" => app()->getLocale()]) }}" 
                        class="nav-link @if(Request::segment(3) == 'quotes') active @endif ">
                        <i class="nav-icon fa fa-quote-left"></i>
                        <p>@lang('admin_panel/quotes.quotes')</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin-panel.logout', ["locale" => app()->getLocale()]) }}" class="nav-link">
                        <i class="nav-icon fa fa-sign-out" aria-hidden="true"></i>
                        <p>@lang('admin_panel/action.log.out')</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
