<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img class="sidebar__logo-icon brand-text" src="{{ asset('assets/img/wellcoinex_logo.png') }}" alt="#" style="width: 176px" />
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'movies' ) active @endif ">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>Movies</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
