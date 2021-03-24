<?php
/**
 * Manage a company data.
 */

namespace App\Models;

use App\Libraries\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This class handles a press kit model.
 */
class Company extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company';

    /** @var array A list of fields which are able to update in this model */
    protected $fillable = [ 'fk_user_id', 'company_name', 'email', 'second_email', 'address', 'lastname', 'mobile', 'status', 'image_path' ];

    /**
     * Get EZusers model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo User model relationship
     */
    public function UsersCompany()
    {
        return $this->HasMany( 'App\Models\UsersCompany', 'fk_company_id' );
    }

    /**
     * Get users profile information.
     *
     * @return Users[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCompanyProfile()
    {
        return $this->where( [ 'fk_user_id' => Auth::user()->id ] )->get();
    }

    /**
     * Get users profile information.
     *
     * @return Users[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getRequestUser( $company )
    {
        $requestUserInformation = [];
        $result                 = DB::table( 'users_company' )->where( [ 'fk_company_id' => $company[0]->id, 'status' => 'pending' ] )->get();

        foreach( $result as $item ){
            $user = DB::table( 'users' )->where( [ 'id' => $item->fk_user_id ] )->get();
            foreach( $user as $userItem ){
                $firstname     = $userItem->firstname;
                $lastname      = $userItem->lastname;
                $country       = $userItem->country;
                $image_path    = $userItem->image_path;
                $id            = $userItem->id;
                $userCompanyID = $item->id;
                array_push( $requestUserInformation, [
                    'id'            => $id,
                    'firstname'     => $firstname,
                    'lastname'      => $lastname,
                    'country'       => $country,
                    'image_path'    => $image_path,
                    'userCompanyID' => $userCompanyID,
                ] );
            }
        }

        return $requestUserInformation;
    }

    /**
     * Create a new Company.
     *
     * @param Request $request Data for creating a new company
     *
     * @return Company              Company model
     */
    public function createCompany( Request $request )
    {
        $data = [
            'fk_user_id'   => Auth::user()->id,
            'company_name' => $request->input( 'company_name' ),
            'email'        => $request->input( 'email' ),
            'second_email' => $request->input( 'second_email' ),
            'address'      => $request->input( 'address' ),
            'country'      => $request->input( 'country' ),
            'state'        => $request->input( 'city_state' ),
            'city'         => $request->input( 'city' ),
            'postcode'     => $request->input( 'postcode' ),
            'phone'        => $request->input( 'phone' ),
            'mobile'       => $request->input( 'mobile' ),
            'website'      => $request->input( 'website' ),
            'status'       => 'active',
        ];

        $companyInfo = $this->getCompanyProfile();

        if( count( $companyInfo ) !== 0 ){
            $result = $this->where( 'fk_user_id', Auth::user()->id )->update( $data );
        } else {
            $result = $this->create( $data );
        }

        if( $result ){
            $response = [ 'success' => true, 'message' => __( 'company.saved_company_success' ), ];
        } else {
            $response = [ 'success' => false, 'message' => __( 'company.saved_company_error' ), ];
        }

        return $response;

    }

    /**
     * Update a user.
     *
     * @param Request $request User request object
     *
     * @return    array
     */
    public function updateCompany( Request $request )
    {

        $data = [
            'company_name' => $request->input( 'company_name' ),
            'email'        => $request->input( 'email' ),
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

        $result = $this->where( 'id', Auth::user()->id )->update( $data );

        if( $result ){
            $response = [ 'success' => true, 'message' => __( 'company.saved_company_success' ), ];
        } else {
            $response = [ 'success' => false, 'message' => __( 'company.saved_company_error' ), ];
        }

        return $response;

    }

    public function updateCompanyImage( Request $request )
    {

        $companyImage = [ 'image_path' => $request->input( 'image_path' ) ];
        $companyInfo  = $this->getCompanyProfile();

        if( count( $companyInfo ) !== 0 ){
            $result = $this->where( 'fk_user_id', Auth::user()->id )->update( $companyImage );
        } else {
            $result = $this->create( [ 'fk_user_id' => Auth::user()->id,
                                       'status'     => 'active',
                                       'image_path' => $request->input( 'image_path' ),
                                     ] );
        }

        if( $result ){
            $response = [ 'success' => true, 'message' => __( 'company.saved_company_success' ), ];
        } else {
            $response = [ 'success' => false, 'message' => __( 'company.saved_company_error' ), ];
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
        $storagePath = 'storage/uploads/company/';
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

    /**
     * Get users profile information.
     *
     * @return Users[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCompanyMember( $company )
    {
        $requestUserInformation = [];
        $result                 = DB::table( 'users_company' )->where( [ 'fk_company_id' => $company[0]->id, 'status' => 'accept' ] )->get();

        foreach( $result as $item ){
            $user = DB::table( 'users' )->where( [ 'id' => $item->fk_user_id ] )->get();
            foreach( $user as $userItem ){
                $firstname     = $userItem->firstname;
                $lastname      = $userItem->lastname;
                $country       = $userItem->country;
                $image_path    = $userItem->image_path;
                $id            = $userItem->id;
                $userCompanyID = $item->id;
                array_push( $requestUserInformation, [
                    'id'            => $id,
                    'firstname'     => $firstname,
                    'lastname'      => $lastname,
                    'country'       => $country,
                    'image_path'    => $image_path,
                    'userCompanyID' => $userCompanyID,
                ] );
            }
        }

        return $requestUserInformation;
    }

}