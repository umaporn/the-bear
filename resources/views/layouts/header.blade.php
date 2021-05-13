<header class="no-js">
    <div class="container header">
        <div class="row p-2 mobile-middle">
            <div class="col-sm-4 col-6">
                <a href="#">
                    <img class="logo" src="{{ asset('images/logo/tbt-travel.png') }}">
                </a>
            </div>
            <div class="col-sm-8 col-6" style="margin-top: auto;margin-bottom: auto; text-align:right">
                <div class="align-middle header-bar">
                    <div class="d-none d-sm-none d-md-block">

                        <nav>
                            <label for="drop" class="toggle">Menu</label>
                            <ul class="menu">
                                <li>
                                    <label for="drop-2" class="toggle">Menu
                                        <i class="fas fa-sort-down"></i>
                                    </label>
                                    <a href="#">MENU <i class="fa fa-sort-down icon-down"></i></a>
                                    <input type="checkbox" id="drop-2"/>
                                    <ul>
                                        @foreach($contentDetail['menu'] as $menu )
                                            <li>
                                                <a href="#">{{ $menu['menuName'] }}
                                                    @if($menu['menuSecondary'])
                                                        <i class="fa fa-sort-down icon-down"></i>
                                                    @endif
                                                </a>
                                                @if($menu['menuSecondary'])
                                                    <input type="checkbox" id="drop-3"/>
                                                    <ul>
                                                        @foreach($menu['menuSecondary'] as $secondary)
                                                            <li><a href="#">
                                                                    {{ $secondary['menuName'] }}
                                                                    @if($secondary['menuThird'])
                                                                        <i class="fa fa-sort-down icon-down"></i>
                                                                    @endif
                                                                </a>
                                                                @if($secondary['menuThird'])
                                                                    <input type="checkbox" id="drop-3"/>
                                                                    <ul>
                                                                        @foreach($secondary['menuThird'] as $third)
                                                                        <li><a href="#">
                                                                                {{ $third['menuName'] }}
                                                                            </a>
                                                                        </li>
                                                                            @endforeach
                                                                    </ul>
                                                                    @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                {{-- <input type="checkbox" id="drop-3"/>
                                                 <ul>
                                                     <li><a href="#">HTML/CSS</a></li>
                                                     <li><a href="#">jQuery</a></li>
                                                     <li><a href="#">Other</a></li>
                                                 </ul>--}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <nav class="navbar navbar-expand-xl navbar-light d-md-none float-right">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>

                    <nav class="navbar navbar-expand-lg navbar-light d-md-none" style="width:100%">
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                            <ul class="nav navbar-nav mr-auto side-menu " style="height:auto;">
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
                                    <input type="checkbox" id="skin-toggle-body">
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