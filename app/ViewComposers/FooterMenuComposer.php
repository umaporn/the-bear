<?php
/**
 * GTM Composer
 */

namespace App\ViewComposers;

use App\Libraries\ServiceRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\FooterMenu;
/**
 * A class for handling GTM codes
 * Assign GTM based on route.
 *
 * @package App\ViewComposers
 */
class FooterMenuComposer
{
    /** @var Sitename sitename model instance */
    private $footerMenuModel;

    /**
     * SitenameController constructor.
     *
     * @param Sitename $sitename Sitename model
     */
    public function __construct( footerMenu $footerMenu )
    {
        $this->footerMenuModel = $footerMenu;
    }

    /**
     * Get GTM tags
     *
     * @return array
     */
    public function getFooterMenu()
    {
        $footerMenu = footerMenu::where( [ 'sitename' => 5, 'status' => 'enable' ] )->get();

        return $footerMenu;

    }

    /**
     * Compose GTM tags for
     *
     * @param View $view Current view
     *
     * @return View Composed view
     */
    public function compose( View $view )
    {
        return $view->with( [ 'footerMenu' => $this->getFooterMenu() ] );
    }
}
