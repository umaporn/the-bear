<li class="nav-item">
    <a href="{{ $menuItem['url'] }}" class="{{ $menuItem['active'] }}">
        {!! $menuItem['menuText'] !!}
    </a>
    @if( count( $menuItem['childMenu'] ) )
    <ul class="dtgo-mainmenu-child">
        @each( 'layouts.main_menu', $menuItem['childMenu'], 'menuItem' )
    </ul>
    @endif
</li>