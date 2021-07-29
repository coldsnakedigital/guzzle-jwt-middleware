<?php

namespace Coldsnakedigital\GuzzleJwt\Persistence;

use Coldsnakedigital\GuzzleJwt\JwtToken;

/**
 * @author Sevastian Hübner <development@tryfailrepeat.de>
 */
class NullTokenPersistence implements TokenPersistenceInterface
{
    public function saveToken(JwtToken $token)
    {
        return;
    }

    public function restoreToken()
    {
        return null;
    }

    public function deleteToken()
    {
        return;
    }

    public function hasToken()
    {
        return false;
    }
}
