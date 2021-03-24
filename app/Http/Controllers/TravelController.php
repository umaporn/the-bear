<?php
/**
 * Travel Page Controller
 */

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;

/**
 * Travel Page Controller
 * @package App\Http\Controllers
 */
class TravelController extends Controller
{
    /**
     * Display travel page.
     *
     * @return Factory|View Travel page
     */
    public function index( Request $request)
    {
        return view( 'travel.index' );
    }

    /**
     * Display travel page.
     *
     * @return Factory|View Travel page
     */
    public function detail( Request $request )
    {
        return view( 'travel.detail' );
    }
}
