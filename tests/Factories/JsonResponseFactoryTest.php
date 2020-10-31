<?php

namespace Edlin\Tests\Factories;

use Edlin\Factories\JsonResponseFactory;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 13/09/18
 * Time: 12:07
 *
 * Class JsonResponseFactoryTest
 * @package Edlin\Tests\Factories
 * @covers  \Edlin\Factories\JsonResponseFactory
 */
final class JsonResponseFactoryTest extends TestCase
{
    const APP_ENV = 'APP_ENV';
    const PAYLOAD = ['456' => 'def'];
    const DEBUG   = ['123' => 'abc'];

    /**
     * @covers \Edlin\Factories\JsonResponseFactory::fail
     */
    public function testFail()
    {
        $this->assertEquals(
            [
                'success' => false,
                'app_env' => getenv(self::APP_ENV),
                'errors'  => [],
                'payload' => [],
                'debug'   => [],
            ],
            JsonResponseFactory::fail()->getResponse()
        );
    }

    /**
     * @covers \Edlin\Factories\JsonResponseFactory::failWithDebug
     */
    public function testFailWithDebug()
    {
        $this->assertEquals(
            [
                'success' => false,
                'app_env' => getenv(self::APP_ENV),
                'errors'  => [],
                'payload' => [],
                'debug'   => self::DEBUG,
            ],
            JsonResponseFactory::failWithDebug(self::DEBUG)->getResponse()
        );
    }

    /**
     * @covers \Edlin\Factories\JsonResponseFactory::success
     */
    public function testSuccess()
    {
        $this->assertEquals(
            [
                'success' => true,
                'app_env' => getenv(self::APP_ENV),
                'errors'  => [],
                'payload' => [],
                'debug'   => [],
            ],
            JsonResponseFactory::success()->getResponse()
        );
    }

    /**
     * @covers \Edlin\Factories\JsonResponseFactory::success
     */
    public function testSuccessWithPayload()
    {
        $this->assertEquals(
            [
                'success' => true,
                'app_env' => getenv(self::APP_ENV),
                'errors'  => [],
                'payload' => self::PAYLOAD,
                'debug'   => [],
            ],
            JsonResponseFactory::successWithPayload(self::PAYLOAD)->getResponse()
        );
    }
}
