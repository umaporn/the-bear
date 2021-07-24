<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Content;
use App\Models\Menu;

class SitemapController extends Controller
{
    /** @var Content Content model */
    protected $contentModel;
    protected $menuModel;

    /**
     * Initialize ContentController class.
     *
     * @param Content $content Users model
     */
    public function __construct( Content $content, Menu $menu )
    {
        $this->contentModel = $content;
        $this->menuModel    = $menu;
    }

    /**
     * Show Sitemap XML.
     *
     * @return    View    Sitemap XML
     */
    public function xml()
    {
        $contentList = $this->contentModel->getContentListForSitemap();
        $menuList    = $this->menuModel->getMenuListForSitemap();

        return response()->view( 'sitemap.xml', compact( 'contentList', 'menuList' ) )
                         ->header( 'Content-Type', 'text/xml' );
    }

}
