<?php
/**
 * Authenticatable user class
 */

namespace App\Libraries;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * This is a user class that implements Authenticatable contract.
 * @package App\Libraries
 */
class AuthenticatableUser implements Authenticatable
{
    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string Identifier name
     */
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return string|null Identifier
     */
    public function getAuthIdentifier()
    {
        return session( $this->getAuthIdentifierName() );
    }

    /**
     * Get the password for the user.
     *
     * @return string|null Password
     */
    public function getAuthPassword()
    {
        $password = session( 'password' );

        return is_null( $password ) ? null : decrypt( $password );
    }

    /**
     * Get the 'Remember me' token.
     *
     * @return string 'Remember me' token
     */
    public function getRememberToken()
    {
        return '';
    }

    /**
     * Set the 'Remember me' token.
     *
     * @param string $value 'Remember me' token
     */
    public function setRememberToken( $value )
    {
    }

    /**
     * Get the 'Remember me' token name.
     *
     * @return string 'Remember me' token name
     */
    public function getRememberTokenName()
    {
        return '';
    }

}
