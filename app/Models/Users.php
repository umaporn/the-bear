<?php
/**
 * Manage a user data.
 */

namespace App\Models;

use App\Libraries\Image;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This class handles a press kit model.
 */
class Users extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /** @var array A list of fields which are able to update in this model */
    protected $fillable = [ 'fk_wallet_id', 'email', 'username', 'kyc_status', 'image_path', 'password', 'firstname', 'lastname', 'mobile', ];

    /** @var array Hidden attributes/fields */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get EZusers model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany User model relationship
     */
    public function UsersCompany()
    {
        return $this->HasMany( 'App\Models\UsersCompany', 'fk_user_id' );
    }

    /**
     * Get EZusers model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany User model relationship
     */
    public function Wallet()
    {
        return $this->belongsTo( 'App\Models\Wallet', 'fk_wallet_id' );
    }

    /**
     * Create a new user.
     *
     * @param Request $request Data for creating a new user
     *
     * @return Users              Users model
     */
    public function createUser( Request $request )
    {
        $newUser = [
            'email'    => $request->input( 'email' ),
            'password' => bcrypt( $request->input( 'password' ) ),
        ];

        $user = $this->create( $newUser );

        return $user;
    }

    /**
     * Get users profile information.
     *
     * @return Users[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUserProfile()
    {
        $result = $this->with( [ 'Wallet' ] )
                       ->where( [ 'id' => Auth::user()->id ] )->get();

        return $result;
    }

    public function getUserCompany()
    {
        $companyInformation = [];
        $result             = DB::table( 'users_company' )->where( [ 'fk_user_id' => Auth::user()->id, 'status' => 'pending' ] )->get();

        foreach( $result as $item ){
            $company = DB::table( 'company' )->where( [ 'id' => $item->fk_company_id ] )->get();
            foreach( $company as $companyItem ){
                $companyName = $companyItem->company_name;
                $companyID   = $companyItem->id;
                $id          = $item->id;
                array_push( $companyInformation, [
                    'id'           => $id,
                    'company_name' => $companyName,
                    'company_id'   => $companyID,
                ] );
            }
        }

        return $companyInformation;
    }

    /**
     * Transform share comment information.
     *
     * @param $shareComment
     *
     * @return mixed
     */
    private function transformData( $profile )
    {
        $compayInformation = [];
        foreach( $profile as $item ){
            foreach( $item->UsersCompany as $subItem ){
                if( $subItem ){
                    $data = DB::table( 'company' )->where( [ 'id' => $subItem->id ] )->get();

                    /*if($data){
                        $subItem->setAttribute( 'company_name', $data[0]->company_name );
                        $subItem->setAttribute( 'company_id', $data[0]->id );
                    }*/
                }
            }
        }

        return $profile;
    }

    /**
     * Update a user.
     *
     * @param Request $request User request object
     *
     * @return    array
     */
    public function updateUser( Request $request )
    {

        $data = [
            'firstname'    => $request->input( 'firstname' ),
            'lastname'     => $request->input( 'lastname' ),
            'title_name'   => $request->input( 'title_name' ),
            'middlename'   => $request->input( 'middlename' ),
            'gender'       => $request->input( 'gender' ),
            'second_email' => $request->input( 'second_email' ),
            'address'      => $request->input( 'address' ),
            'country'      => $request->input( 'country' ),
            'state'        => $request->input( 'city_state' ),
            'city'         => $request->input( 'city' ),
            'postcode'     => $request->input( 'postcode' ),
            'phone'        => $request->input( 'phone' ),
            'mobile'       => $request->input( 'mobile' ),
            'website'      => $request->input( 'website' ),
        ];

        /*if( $request->file( 'image_path' ) ){
            $imageInformation = $this->saveImage( $request );

            if( isset( $imageInformation['imageInformation']['original'] ) ){
                $image_file = $imageInformation['imageInformation']['original'];

                $data['image_path'] = $image_file;
            }
        }*/

        $result = $this->where( 'id', Auth::user()->id )->update( $data );

        if( $result ){
            $response = [ 'success' => true, 'message' => __( 'user.saved_user_success' ), ];
        } else {
            $response = [ 'success' => false, 'message' => __( 'user.saved_user_error' ), ];
        }

        return $response;

    }

    public function updateProfileImage( Request $request )
    {

        $result = $this->where( 'id', Auth::user()->id )->update( [ 'image_path' => $request->input( 'image_path' ) ] );

        if( $result ){
            $response = [ 'success' => true, 'message' => __( 'user.saved_user_success' ), ];
        } else {
            $response = [ 'success' => false, 'message' => __( 'user.saved_user_error' ), ];
        }

        return $response;
    }

    /**
     * Handle image upload from file browser.
     *
     * @param Request $request Request object
     *
     * @return array Image saved result
     */
    public function saveImage( Request $request )
    {
        $imageInformation = [];
        $file             = $request->input( 'profile_image' );

        $pos         = strpos( $file, ';' );
        $type        = explode( ':', substr( $file, 0, $pos ) )[1];
        $mime        = explode( '/', $type );
        $storagePath = 'storage/uploads/users/';
        if( !is_dir( $storagePath ) ){
            mkdir( $storagePath, 0755, true );
        }

        $pathImage = $storagePath . time() . '.' . $mime[1];

        $file       = substr( $file, strpos( $file, ',' ) + 1, strlen( $file ) );
        $dataBase64 = base64_decode( $file );
        $result     = file_put_contents( $pathImage, $dataBase64 );

        $success = true;

        if( $result ){
            $imageInformation = $pathImage;
        }

        return [ 'image_path' => $imageInformation ];
    }
}