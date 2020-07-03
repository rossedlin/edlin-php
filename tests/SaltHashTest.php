<?php

namespace Edlin\Tests;

use Edlin\SaltHash;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/10/2017
 * Time: 11:50
 *
 * Class SaltHashTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\SaltHash
 */
final class SaltHashTest extends TestCase
{
    /**
     * @covers \Edlin\SaltHash::generateHash
     */
    public function testGenerateHash()
    {
        $passwords = [
            'fgyb23n0f3-o'             => '287eda88d53756ac1e0d958f56974a4b58c9c08047a699a9aa3777d2b98e808b05a19b1ba78da7085b733a7192f52a276bfeecc7cf92f3a4ed23ff7e89aa36bc',
            'B4wsQF2L2epKq4Y8'         => '14b09f416c9584ef0bb167b3ae6d4901580bc860e5c7dccb794b9040e1608081aab3e148776e475336cb1567bdf448e896d5d350bcb5687fa340008cc4b1f10a',
            'OnoM]D)ûp6vWP6_w«1~Iå}2%' => '5fbe83bf2b6c7ab5b0006c70205f7a839afa39abaf9be9ec03c79e2d600aaf23a3592b4a5ee33cf87000b6b6f9bae0c0ac4ad896338df9bd815b764736f46809',
        ];

        foreach ($passwords as $password => $hash) {
            $this->assertEquals(strlen(SaltHash::generateHash($password)), 128);
            $this->assertEquals(SaltHash::generateHash($password), $hash);
        }
    }

    /**
     *
     */
    public function testGenerateSalt()
    {
        $this->assertEquals(strlen(SaltHash::generateSalt()), 32);
        $this->assertEquals(strlen(SaltHash::generateSalt()), 32);
        $this->assertEquals(strlen(SaltHash::generateSalt()), 32);
    }

    /**
     * @covers \Edlin\SaltHash::generateSaltHash
     * @throws \Exception
     */
    public function testGenerateSaltHash()
    {
        $passwords = [
            '8ZPu8G5vD8Fg2zJj' => 'p6Kp1nbvBc2Q4G5Z4NguCdL47Lyg71DN',
            'H9qY3cyHp1xJ5N9T' => SaltHash::generateSalt(),
            'j63ki1VV6QiESiL8' => 'M9CL2p1T5nXdXtyngDn2r5wM1134cESF',
        ];

        foreach ($passwords as $password => $salt) {
            $saltHash = SaltHash::generateSaltHash($password);

            $this->assertEquals(32, strlen($saltHash['salt']));
            $this->assertEquals(128, strlen($saltHash['hash']));
        }
    }

    /**
     * @covers \Edlin\SaltHash::validateSaltHash
     * @throws \Exception
     */
    public function testValidateSaltHash()
    {
        $passwords = [
            '8ZPu8G5vD8Fg2zJj' => ['salt' => 'M9CL2p1T5nXdXtyngDn2r5wM1134cESF', 'hash' => '30d3d20b6711b10399468ba468667ac1d5b27fbfb0700327530709779fea32430d93c1c8c69a1666e94d58f404c5096a8914d0563ad13beb35415263d71af3d3'],
            'H9qY3cyHp1xJ5N9T' => ['salt' => 'P4K1ZbDeC9K1h2PQi5hU6qEnXk68h3pc', 'hash' => '45fb9d348830152ff543bc5f281ff8c61943272196ba522f01cea9b5617bd1a37b50f83795605676e9b81726a2ef504c1848800b00a7c7b7db799955a150e453'],
            'j63ki1VV6QiESiL8' => ['salt' => 'QWgXjm7jHc7n39c2GjnYd62YM5Lx6L7N', 'hash' => '80492156c808e4585f0776b2f040e267a53daee9b54d8b1453637ff597ab9e1b0483feffba0351b8f94a80be42807c993340aaf2db631cc3599661656351d03d'],
        ];

        foreach ($passwords as $password => $saltHash) {
            $result = SaltHash::validateSaltHash($password, $saltHash['salt']);

            $this->assertEquals(32, strlen($result['salt']));
            $this->assertEquals(128, strlen($result['hash']));
            $this->assertEquals($saltHash['hash'], $result['hash']);
        }
    }
}
