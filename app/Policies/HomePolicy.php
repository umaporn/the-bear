<?php
/**
 * Home page policy
 */

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

/**
 * Home Page Policy
 * @package App\Policies
 */
class HomePolicy
{
    use HandlesAuthorization;

    /**
     * Check whether the current user is authenticated.
     *
     * @return bool
     */
    public function view()
    {
        return Auth::check();
    }
}
