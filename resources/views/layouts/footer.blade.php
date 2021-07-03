<div class="section-footer">
    <div class="container-full">
        <div class="footer-inner">
            <div class="row footer-row">
                <h5>Our website</h5>
            </div>
            <div class="footer-row align-items-center pt-3 pb-3 row">
                <div class="col-4 col-sm-6 col-md-6 col-lg-4 p-2">
                    <a href="{{ route('travel.index') }}"><img src="{{ asset('images/logo-footer/travel.png') }}" class="footer-image" alt="tbt-travel"></a>
                </div>
                <div class="col-4 col-sm-6 col-md-6 col-lg-4 p-2 text-center">
                    <a href="http://thebear.world/" target="_blank"><img src="{{ asset('images/logo-footer/world.png') }}" class="footer-image" alt="tbt-travel"></a>
                </div>
                <div class="col-4 col-sm-6 col-md-6 col-lg-4 p-2 text-right">
                    <a href="http://thebear.lgbt/" target="_blank"><img src="{{ asset('images/logo-footer/lgbt.png') }}" class="footer-image" alt="tbt-travel"></a>
                </div>
                <div class="col-4 col-sm-6 col-md-6 col-lg-4 p-2">
                    <a href="http://thebear.technology/" target="_blank"><img src="{{ asset('images/logo-footer/tech.png') }}" class="footer-image" alt="tbt-travel"></a>
                </div>
                <div class="col-4 col-sm-6 col-md-6 col-lg-4 p-2 text-center">
                    <a href="http://thebear.technology/" target="_blank"><img src="{{ asset('images/logo-footer/earth.png') }}" class="footer-image" alt="tbt-travel"></a>
                </div>
                <div class="col-4 col-sm-6 col-md-6 col-lg-4 p-2 text-right">
                    <a href="http://thebear.group/" target="_blank"><img src="{{ asset('images/logo-footer/group.png') }}" class="footer-image" alt="tbt-travel"></a>
                </div>
            </div>
            <div class="footer-information" style="border-top: 1px solid white">
                <div class="row footer-row pb-2">
                    <div class="col-sm icon-center d-none d-sm-block">
                        <small>
                            © Copyright 2017-2021. All Rights Reserved
                        </small>
                    </div>
                    <div class="col-sm footer-list last-menu d-block d-sm-none pb-2">
                        <a href="#" class="pr-2">Contact</a>
                        <a href="#" class="pr-2">Work with us</a>
                        <a href="#" class="pr-2">Legal</a>
                    </div>
                    <div class="col-sm">
                        <div class="row icon-center-social">
                            @foreach($socialButton as $icon )
                                <a href="{{ $icon->url }}" target="_blank">
                                    <img src="data:image/png;base64,{{ $icon->new_main_image }}"
                                         alt="{{ $icon->name }}" title="{{ $icon->name }}" class="pr-2">
                                </a>
                             @endforeach
                        </div>
                    </div>
                    <div class="col-sm footer-list last-menu d-none d-sm-block">
                        @foreach($footerMenu as $item )
                        <a href="{{ $item->url }}" class="pr-2" target="_blank">{{ $item->name }}</a>
                        @endforeach
                    </div>
                    <div class="col-sm icon-center d-block d-sm-none">
                        <small>
                            © Copyright 2017-2021. All Rights Reserved
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
