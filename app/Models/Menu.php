<?php
/**
 * Manage a menu data.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This class handles a author model.
 */
class Menu extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * Get Menu model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo User model relationship
     */
    public function Content()
    {
        return $this->hasMany( 'App\Models\Menu', 'menu' );
    }

}