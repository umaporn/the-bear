<header class="no-js">
    <div class="container header">
        <div class="row p-2">
            <div class="col-md-4">
                <a href="#">
                    <img class="logo" src="{{ asset('images/logo/tbt-travel.png') }}">
                </a>
            </div>
            <div class="col-md" style="margin-top: auto;margin-bottom: auto; text-align:right">
                <div class="align-middle header-bar">

                    <span class="sun">
                        <img src="{{ asset('images/sun.svg') }}">
                    </span>

                    <label class="switch">
                        <input type="checkbox" id="skin-toggle">
                        <span class="slider round" ></span>
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
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>

                    </span>
                    {{--<nav class="navbar navbar-expand-xl navbar-light d-md-none" style="text-align:right;">
                        <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                    <nav class="navbar navbar-expand-lg navbar-light d-md-none" style="width:100%">
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                            <ul class="nav navbar-nav mr-auto" style="height:auto;">

                            </ul>
                        </div>
                    </nav>--}}
                </div>
            </div>
        </div>
    </div>
</header>