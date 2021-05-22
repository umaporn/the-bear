<?php
/**
 * Manage a author data.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This class handles a author model.
 */
class Sitename extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sitename';

}