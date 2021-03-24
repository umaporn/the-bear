<?php
/**
 * Language controller
 */

namespace App\Http\Controllers;

use App\Support\Facades\Utility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Language Controller
 * @package App\Http\Controllers
 */
class LanguageController extends Controller
{
    /**
     * Change system language.
     *
     * @param Request $request      HTTP request object
     * @param string  $languageCode Language code
     *
     * @return Redirector|RedirectResponse HTTP redirect response
     */
    public function changeLanguage( Request $request, string $languageCode )
    {
        $redirectedUrl = Utility::getRedirectedUrl( $languageCode );

        $request->session()->put( 'url.intended', $redirectedUrl );

        return redirect( $redirectedUrl );
    }
}
