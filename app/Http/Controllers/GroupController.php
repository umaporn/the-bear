<?php
/**
 * Group Page Controller
 */

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;

/**
 * Group Page Controller
 * @package App\Http\Controllers
 */
class GroupController extends Controller
{
    /**
     * Display group page.
     *
     * @return Factory|View Group page
     */
    public function index( Request )
    {

        return view( 'group.index' );
    }

    /**
     * Display group page.
     *
     * @return Factory|View Group page
     */
    public function detail( Request $request )
    {
        return view( 'group.detail' );
    }
}
