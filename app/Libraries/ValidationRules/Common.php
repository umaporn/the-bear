<?php
/**
 * Manage extended common validation rules.
 */

namespace App\Libraries\ValidationRules;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * This class keeps all extended common validation rules.
 * @package App\Libraries\ValidationRules
 */
class Common
{
    /**
     * Validate whether the input's value is zero or exists in the database.
     *
     * @param string $attribute  Input field name to validate
     * @param string $value      Input's value
     * @param array  $parameters Rule's parameters
     *
     * @return boolean Validation result
     */
    public static function validateZeroOrExistsRule( string $attribute, string $value, array $parameters )
    {
        if( $value == 0 ){
            return true;
        }

        $newValidator = Validator::make(
            [ $attribute => $value ],
            [ $attribute => 'exists:' . implode( ",", $parameters ) ]
        );

        return $newValidator->passes();
    }

    /**
     * Validate the input's value against the current password.
     *
     * @param string $attribute Input field name to validate
     * @param string $value     Input's value
     *
     * @return boolean Validation result
     */
    public static function validatePassword( string $attribute, string $value )
    {
        return Hash::check( $value, Auth::user()->getAuthPassword() );
    }

    /**
     * Validate whether the data from checkbox inputs are in the given list of rule's parameters.
     *
     * @param string $attribute  Input field name to validate
     * @param array  $values     List of input's value
     * @param array  $parameters Rule's parameters
     *
     * @return boolean Validation result
     */
    public static function validateCheckboxInRule( string $attribute, array $values, array $parameters )
    {
        foreach( $values as $value ){

            $newValidator = Validator::make( [ $attribute => $value ], [ $attribute => Rule::in( $parameters ) ] );

            if( $newValidator->fails() ){
                return false;
            }
        }

        return true;
    }
}