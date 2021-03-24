<?php
/**
 * User Provider
 */

namespace App\Providers;

use App\Libraries\AuthenticatableUser;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * User Provider
 * @package App\Providers
 */
class UserProvider implements \Illuminate\Contracts\Auth\UserProvider
{
    /** @var AuthenticatableUser User */
    private $user;

    /**
     * UserProvider constructor.
     *
     * @param AuthenticatableUser $user User
     */
    public function __construct( AuthenticatableUser $user )
    {
        $this->user = $user;
    }

    /**
     * Retrieve a user by a unique identifier.
     *
     * @param string $identifier Unique identifier
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null User
     */
    public function retrieveById( $identifier )
    {
        return $this->user->getAuthIdentifier() === $identifier ? $this->user : null;
    }

    /**
     * Retrieve a user by a unique identifier and "Remember me" token.
     *
     * @param string $identifier Unique identifier
     * @param string $token      "Remember me" token
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null User
     */
    public function retrieveByToken( $identifier, $token )
    {
        return null;
    }

    /**
     * Update "Remember me" token.
     *
     * @param Authenticatable $user  User
     * @param string          $token "Remember me" token
     */
    public function updateRememberToken( Authenticatable $user, $token )
    {
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials Credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null User
     */
    public function retrieveByCredentials( array $credentials )
    {
        return isset( $credentials[ $this->user->getAuthIdentifierName() ] )
               && $credentials[ $this->user->getAuthIdentifierName() ] === $this->user->getAuthIdentifier()
            ? $this->user : null;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param Authenticatable $user        User
     * @param array           $credentials Credentials
     *
     * @return boolean
     */
    public function validateCredentials( Authenticatable $user, array $credentials )
    {
        return $user->getAuthPassword() === $credentials['password'];
    }

}
