<?php
/**
 * GTM Composer
 */

namespace App\ViewComposers;

use App\Libraries\ServiceRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\SocialButton;
/**
 * A class for handling GTM codes
 * Assign GTM based on route.
 *
 * @package App\ViewComposers
 */
class SocialButtonComposer
{
    /** @var Sitename sitename model instance */
    private $socialButtonModel;

    /**
     * SitenameController constructor.
     *
     * @param Sitename $sitename Sitename model
     */
    public function __construct( socialButton $socialButton )
    {
        $this->socialButtonModel = $socialButton;
    }

    /**
     * Get GTM tags
     *
     * @return array
     */
    public function getSocialButton()
    {
        $socialButton = socialButton::where( [ 'sitename' => 5, 'status' => 'enable' ] )->get();
        $socialButton = $this->transformMainImage($socialButton);

        return $socialButton;

    }

    private function transformMainImage( $data )
    {
        foreach( $data as $list ){
            $image = ServiceRequest::call(
                'GET',
                '/assets/' . $list->social_logo,
                true,
                );
            $list->setAttribute( 'new_main_image', $image );
        }
        return $data;

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
        return $view->with( [ 'socialButton' => $this->getSocialButton() ] );
    }
}
