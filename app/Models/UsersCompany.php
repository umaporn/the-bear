<?php
/**
 * Manage a company data.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This class handles a press kit model.
 */
class UsersCompany extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_company';

    /** @var array A list of fields which are able to update in this model */
    protected $fillable = [ 'fk_user_id', 'fk_company_id', 'status' ];

    /**
     * Get EZusers model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany User model relationship
     */
    public function Users()
    {
        return $this->belongsTo( 'App\Models\Users', 'id' );
    }

    /**
     * Get EZusers model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany User model relationship
     */
    public function Company()
    {
        //return $this->belongsTo( 'App\Models\Company', 'id' );
        return $this->belongsToMany( 'App\Models\Company', 'users', 'fk_company_id', 'fk_user_id' );
    }

    public function createUsersCompany( $request )
    {
        $newUsersCompany = [
            'fk_user_id'    => Auth::user()->id,
            'fk_company_id' => $request->input( 'fk_company_id' ),
            'status'        => 'pending',
        ];

        $result = $this->create( $newUsersCompany );

        if( $result ){
            $response = [ 'success' => true, 'message' => 'your request has been completed successfully.', ];
        } else {
            $response = [ 'success' => false, 'message' => 'your request has been fail.Please contact administrator.', ];
        }

        return $response;
    }

    public function updateUsersCompany( $request )
    {
        $result = $this->where( [ 'id' => $request->input( 'id' ) ] )
                       ->update( [ 'status' => $request->input( 'status' ) ] );

        if( $result ){
            $response = [ 'success' => true, 'message' => 'your request has been completed successfully.', ];
        } else {
            $response = [ 'success' => false, 'message' => 'your request has been fail.Please contact administrator.', ];
        }

        return $response;
    }
}