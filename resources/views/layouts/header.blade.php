<header class="no-js">
    <div class="container header">
        <div class="row p-2">
            <div class="col-sm-4 col-6">
                <a href="#">
                    <img class="logo" src="{{ asset('images/logo/tbt-travel.png') }}">
                </a>
            </div>
            <div class="col-sm-8 col-6" style="margin-top: auto;margin-bottom: auto; text-align:right">
                <div class="align-middle header-bar">
                    <div class="d-none d-sm-none d-md-block">
                    <span class="sun">
                        <img src="{{ asset('images/sun.svg') }}">
                    </span>

                        <label class="switch">
                            <input type="checkbox" id="skin-toggle-mobile">
                            <span class="slider round"></span>
                        </label>

                        <span class="moon"><img src="{{ asset('images/moon.svg') }}"></span>
                        <label class="search">
                            <i class="fa fa-search"></i>
                        </label>

                        <span class="subscribe-button text-uppercase">
                        <a href="#">Subscribe</a>
                    </span>

                        <span class="dropdown">
                        <button class="btn dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            @if($contentDetail['menu'])
                                @foreach( $contentDetail['menu'] as $menu )
                                    <a class="dropdown-item" href="#">{{ $menu['menuName'] }}</a>
                                @endforeach
                            @endif
                        </div>
                    </span>
                    </div>
                    <nav class="navbar navbar-expand-xl navbar-light d-md-none float-right">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>

                    <nav class="navbar navbar-expand-lg navbar-light d-md-none" style="width:100%">
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                            <ul class="nav navbar-nav mr-auto side-menu " style="height:auto;">
                                <li class="main-menu">Main Menu</li>
                                @if($contentDetail['menu'])
                                    @foreach( $contentDetail['menu'] as $menu )
                                        <li class="nav-item">
                                            <a href="">{{ $menu['menuName'] }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>

                            <div class="text-uppercase p-1">
                                <a href="#">Subscribe</a>
                            </div>

                            <div class="p-1">
                            <span class="sun">
                                <img src="{{ asset('images/sun.svg') }}">
                            </span>

                                <label class="switch">
                                    <input type="checkbox" id="skin-toggle">
                                    <span class="slider round"></span>
                                </label>

                                <span class="moon"><img src="{{ asset('images/moon.svg') }}"></span>
                            </div>
                            <div class="p-1">
                                <a href="#">
                                <label class="search">
                                    <i class="fa fa-search"></i> Search
                                </label>
                                </a>
                            </div>

                        </div>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</header>