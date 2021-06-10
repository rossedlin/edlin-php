<?php

namespace Edlin\Tests;

use Edlin\Email;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 10/06/2021
 * Time: 12:10
 *
 * Class EmailTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Email
 */
final class EmailTest extends TestCase
{
    /**
     * @covers \Edlin\Email::isValid
     */
    public function testGetOnlyNumbers()
    {
        $this->assertTrue(Email::isValid('test@rossedlin.com'));

        /**
         * Failures
         */
        $this->assertFalse(Email::isValid(' test@rossedlin.com'));
        $this->assertFalse(Email::isValid(' test@rossedlin.com '));
        $this->assertFalse(Email::isValid('test@rossedlin.com '));
        $this->assertFalse(Email::isValid('test@rossedlincom'));
        $this->assertFalse(Email::isValid('testrossedlin.com'));
    }
}
