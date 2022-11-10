<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route("admin-panel.movies.index", ["locale" => app()->getLocale()]) }}" class="brand-link">
        Movie Quotes
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin-panel.movies.index", ["locale" => app()->getLocale()]) }}" 
                        class="nav-link @if(Request::segment(3) == 'movies' || Request::segment(3) == '' ) active @endif ">
                        <i class="nav-icon fa fa-film"></i>
                        <p>Movies</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin-panel.quotes.index", ["locale" => app()->getLocale()]) }}" class="nav-link @if(Request::segment(3) == 'quotes' ) active @endif ">
                        <i class="nav-icon fa fa-quotes"></i>
                        <i class="nav-icon fa-quote"></i>
                        <p>Quotes</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin-panel.movie-directors.index", ["locale" => app()->getLocale()]) }}" 
                        class="nav-link @if(Request::segment(3) == 'movie-directors' ) active @endif ">
                        <i class="nav-icon fa fa-video"></i>
                        <p>Movie Directors</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin-panel.logout', ["locale" => app()->getLocale()]) }}" class="nav-link">
                        <i class="nav-icon fa fa-sign-out" aria-hidden="true"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
