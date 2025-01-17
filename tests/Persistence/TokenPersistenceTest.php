<?php

namespace Coldsnakedigital\GuzzleJwt\Tests\Persistence;

use Coldsnakedigital\GuzzleJwt\JwtToken;
use Coldsnakedigital\GuzzleJwt\Persistence\NullTokenPersistence;
use Coldsnakedigital\GuzzleJwt\Persistence\SimpleCacheTokenPersistence;
use Kodus\Cache\MockCache;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Nicolas Reynis (nreynis)
 */
class TokenPersistenceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * testNullTokenPersistence.
     */
    public function testNullTokenPersistence()
    {
        $tokenPersistence = new NullTokenPersistence();
        $token = new JwtToken('foo', new \DateTime('now'));

        $tokenPersistence->saveToken($token);

        $this->assertFalse($tokenPersistence->hasToken());
        $this->assertNull($tokenPersistence->restoreToken());
    }

    /**
     * testSimpleCacheTokenPersistenceInterface.
     * Makes sure we only use the interface methods.
     */
    public function testSimpleCacheTokenPersistenceInterface()
    {
        $simpleCache = $this->createMock(CacheInterface::class);
        $tokenPersistence = new SimpleCacheTokenPersistence($simpleCache);
        $token = new JwtToken('foo', new \DateTime('now'));

        $this->assertNull($tokenPersistence->saveToken($token));
        $this->assertNull($tokenPersistence->hasToken());
        $this->assertNull($tokenPersistence->restoreToken());
        $this->assertNull($tokenPersistence->deleteToken());
    }

    /**
     * testSimpleCacheTokenPersistence.
     */
    public function testSimpleCacheTokenPersistence()
    {
        $simpleCache = new MockCache();
        $tokenPersistence = new SimpleCacheTokenPersistence($simpleCache);
        $token = new JwtToken('foo', new \DateTime('now'));

        $tokenPersistence->saveToken($token);

        $this->assertTrue($tokenPersistence->hasToken());
        $this->assertEquals($tokenPersistence->restoreToken()->getToken(), $token->getToken());

        $tokenPersistence->deleteToken();

        $this->assertFalse($tokenPersistence->hasToken());
        $this->assertNull($tokenPersistence->restoreToken());
    }
}
