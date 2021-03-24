<?php
/**
 * Manage a wallet data.
 */

namespace App\Models;

use App\Libraries\Search;
use App\Libraries\ServiceRequest;
use App\Libraries\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

/**
 * This class handles a wallet information model.
 */
class Wallet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wallet';

    /** @var array A list of fields which are able to update in this model */
    protected $fillable = [ 'id', 'wallet_title', 'wallet_token', 'wallet_id' ];


}