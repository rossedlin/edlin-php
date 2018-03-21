<?php

namespace Cryslo\Core;

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/10/2017
 * Time: 11:50
 *
 * @covers Email
 *
 * Class EncryptionTest
 */
final class SaltHash512Test extends TestCase
{
    /**
     *
     */
    public function testGenerateHash()
    {
        $passwords = [
            'fgyb23n0f3-o'             => '287eda88d53756ac1e0d958f56974a4b58c9c08047a699a9aa3777d2b98e808b05a19b1ba78da7085b733a7192f52a276bfeecc7cf92f3a4ed23ff7e89aa36bc',
            'B4wsQF2L2epKq4Y8'         => '14b09f416c9584ef0bb167b3ae6d4901580bc860e5c7dccb794b9040e1608081aab3e148776e475336cb1567bdf448e896d5d350bcb5687fa340008cc4b1f10a',
            'OnoM]D)ûp6vWP6_w«1~Iå}2%' => '5fbe83bf2b6c7ab5b0006c70205f7a839afa39abaf9be9ec03c79e2d600aaf23a3592b4a5ee33cf87000b6b6f9bae0c0ac4ad896338df9bd815b764736f46809',
        ];

        foreach ($passwords as $password => $hash)
        {
            $this->assertEquals(strlen(SaltHash512::generateHash($password)), 128);
            $this->assertEquals(SaltHash512::generateHash($password), $hash);
        }
    }

    /**
     *
     */
    public function testGenerateSalt()
    {
        $this->assertEquals(strlen(SaltHash512::generateSalt()), 32);
        $this->assertEquals(strlen(SaltHash512::generateSalt()), 32);
        $this->assertEquals(strlen(SaltHash512::generateSalt()), 32);
    }

    /**
     * @throws \Exception
     */
    public function testGeneratePassword()
    {
        $passwords = [
            '8ZPu8G5vD8Fg2zJj' => null,
            'H9qY3cyHp1xJ5N9T' => SaltHash512::generateSalt(),
            'j63ki1VV6QiESiL8' => 'M9CL2p1T5nXdXtyngDn2r5wM1134cESF',
        ];

        foreach ($passwords as $password => $salt)
        {
            $saltHash = SaltHash512::generateSaltHashFromPassword($password, $salt);

            $this->assertEquals(32, strlen($saltHash['salt']));
            $this->assertEquals(128, strlen($saltHash['hash']));
        }
    }
}