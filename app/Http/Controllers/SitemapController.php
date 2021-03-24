<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $pages = config( 'sitemap' );

        return view( 'sitemap.index', compact( 'pages' ) );
    }

    /**
     * Show Sitemap XML.
     *
     * @return    View    Sitemap XML
     */
    public function xml()
    {
        $pages = config( 'sitemap' );

        return response()->view( 'sitemap.xml', compact( 'pages' ) )
                         ->header( 'Content-Type', 'text/xml' );
    }

}
