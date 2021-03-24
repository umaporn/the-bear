<div class="p-3 row justify-content-between">
    <img src="{{ asset('images/logo/global_carbon_holding_logo_small.png') }}"/>
    <nav class="navbar navbar-expand-xl navbar-light d-md-none" style="text-align:right;">
        <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light d-md-none" style="width:100%">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="nav navbar-nav mr-auto side-menu" style="height:auto;">
                @each( 'layouts.main_menu', $mainMenu, 'menuItem' )
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" name="submit">
                        {{ csrf_field() }}
                    </form>
                    <a onclick="document.logout.submit();" style="cursor:pointer">
                        <img src="{{ asset('images/menu/logout.svg')  }}" width=20> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<ul class="nav flex-column side-menu d-none d-sm-none d-md-block">
    @each( 'layouts.main_menu', $mainMenu, 'menuItem' )
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" name="logout">
            {{ csrf_field() }}

        </form>
        <a onclick="document.logout.submit();" style="cursor:pointer">
            <img src="{{ asset('images/menu/logout.svg')  }}" width=20> Logout
        </a>
    </li>
</ul>


