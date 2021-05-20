<header class="no-js">
    <div class="header">
        <div class="row p-2 mobile-middle">
            <div class="col-sm-4 col-4">
                <a href="{{ route('travel.index') }}">
                    <img class="logo" src="{{ asset('images/logo/tbt-travel.png') }}">
                </a>
            </div>
            <div class="col-sm-8 col-8" style="margin-top: auto;margin-bottom: auto; text-align:right">
                <div class="align-middle header-bar">
                    <div class="d-none d-sm-none d-md-block">

                        <nav>
                            <label for="drop" class="toggle">Menu</label>
                            <ul class="menu">
                                <li>
                                    <label for="drop-2" class="toggle">Menu
                                        <i class="fas fa-sort-down"></i>
                                    </label>
                                    <a href="#" style="font-size:20px">MENU
                                        <i class="fa fa-sort-down icon-down"></i></a>
                                    <input type="checkbox" id="drop-2"/>
                                    <ul>
                                        @foreach($contentDetail['menu'] as $menu )
                                            <li>
                                                <a href="{{ route('travel.menu', ['menuID' => $menu['id'] , 'slug' => str_replace(' ', '-', $menu['menuName']) ]) }}">{{ $menu['menuName'] }}
                                                    @if($menu['menuSecondary'])
                                                        <i class="fa fa-sort-down icon-down"></i>
                                                    @endif
                                                </a>
                                                @if($menu['menuSecondary'])
                                                    <input type="checkbox" id="drop-3"/>
                                                    <ul>
                                                        @foreach($menu['menuSecondary'] as $secondary)
                                                            <li><a href="{{ route('travel.menu', ['menuID' => $secondary['id'] , 'slug' => str_replace(' ', '-', $secondary['menuName']) ]) }}">
                                                                    {{ $secondary['menuName'] }}
                                                                    @if($secondary['menuThird'])
                                                                        <i class="fa fa-sort-down icon-down"></i>
                                                                    @endif
                                                                </a>
                                                                @if($secondary['menuThird'])
                                                                    <input type="checkbox" id="drop-3"/>
                                                                    <ul style="right:200px;">
                                                                        @foreach($secondary['menuThird'] as $third)
                                                                            <li><a href="{{ route('travel.menu', ['menuID' => $third['id'] , 'slug' => str_replace(' ', '-', $third['menuName']) ]) }}">
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
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                            <ul>
                                <a href="{{ route('travel.search') }}">
                                    <label class="search">
                                        <i class="fa fa-search"></i> Search
                                    </label>
                                </a>
                            </ul>
                            <span class="text-a"></span>
                            <input type="range" class="slider" min="1" max="3" step="1" id="font-range">
                            <span class="text-a-last"></span>

                            <ul class="p-2">
                            <span class="sun">
                                <img src="{{ asset('images/sun.svg') }}" class="sun-image">
                            </span>

                                <label class="switch">
                                    <input type="checkbox" id="skin-toggle-body">
                                    <span class="slider-layout round"></span>
                                </label>

                                <span class="moon"><img src="{{ asset('images/moon.svg') }}" class="moon-image"></span>
                            </ul>
                        </nav>
                    </div>

                    <nav class="navbar navbar-expand-xl navbar-light d-md-none float-right">
                        <span class="text-a"></span>
                        <input type="range" class="slider" min="1" max="3" step="1" id="font-range-mobile">
                        <span class="text-a-last"></span>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>

                    <nav class="navbar navbar-expand-lg navbar-light d-md-none" style="width:100%">
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="width:100%">
                            <ul class="nav navbar-nav mr-auto side-menu" style="height:auto;">
                                @foreach($contentDetail['menu'] as $menu )
                                    <li>
                                        <a href="{{ route('travel.menu', ['menuID' => $menu['id'] , 'slug' => str_replace(' ', '-', $menu['menuName']) ]) }}">
                                            @if($menu['menuSecondary'])
                                                <i class="fa fa-sort-down icon-down"></i>
                                            @endif
                                            {{ $menu['menuName'] }}

                                        </a>
                                        @if($menu['menuSecondary'])
                                            <input type="checkbox" id="drop-3"/>
                                            <ul>
                                                @foreach($menu['menuSecondary'] as $secondary)
                                                    <li><a href="{{ route('travel.menu', ['menuID' => $secondary['id'] , 'slug' => str_replace(' ', '-', $secondary['menuName']) ]) }}" style="padding-right:25px;">
                                                            @if($secondary['menuThird'])
                                                                <i class="fa fa-sort-down icon-down"></i>
                                                            @endif
                                                            {{ $secondary['menuName'] }}

                                                        </a>
                                                        @if($secondary['menuThird'])
                                                            <input type="checkbox" id="drop-3"/>
                                                            <ul style="right:200px;">
                                                                @foreach($secondary['menuThird'] as $third)
                                                                    <li><a href="{{ route('travel.menu', ['menuID' => $third['id'] , 'slug' => str_replace(' ', '-', $third['menuName']) ]) }}" style="padding-right:35px;">
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
                                    </li>
                                @endforeach
                            </ul>
                            <div class="p-2">
                            <span class="sun">
                                <img src="{{ asset('images/sun.svg') }}" class="sun-image">
                            </span>

                                <label class="switch">
                                    <input type="checkbox" id="skin-toggle">
                                    <span class="slider-layout round"></span>
                                </label>

                                <span class="moon"><img src="{{ asset('images/moon.svg') }}" class="moon-image"></span>
                            </div>
                            <div class="p-1">
                                <a href="{{ route('travel.search') }}">
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