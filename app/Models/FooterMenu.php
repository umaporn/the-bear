<?php
/**
 * Manage a social button data.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This class handles a social button model.
 */
class FooterMenu extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'footer_menu';

}