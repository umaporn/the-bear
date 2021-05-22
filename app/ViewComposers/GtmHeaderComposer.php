<?php
/**
 * GTM Composer
 */

namespace App\ViewComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Sitename;
/**
 * A class for handling GTM codes
 * Assign GTM based on route.
 *
 * @package App\ViewComposers
 */
class GtmHeaderComposer
{
    /** @var Sitename sitename model instance */
    private $sitenameModel;

    /**
     * SitenameController constructor.
     *
     * @param Sitename $sitename Sitename model
     */
    public function __construct( Sitename $sitename )
    {
        $this->sitenameModel = $sitename;
    }

    /**
     * Get GTM tags
     *
     * @return array
     */
    public function getGtmHeaderTags()
    {
        $gtmTags = Sitename::where( 'id', 5 )->get('header_code');

        return $gtmTags;

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
        return $view->with( [ 'gtmHeaderTags' => $this->getGtmHeaderTags() ] );
    }
}
