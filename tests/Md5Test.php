<?php

namespace Edlin\Tests;

use Edlin\Directory;
use Edlin\Md5;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 18/09/2021
 * Time: 20:18
 *
 * @covers  \Edlin\Md5
 */
final class Md5Test extends TestCase
{
    /**
     * @covers \Edlin\Md5::directory
     */
    public function testDirectory()
    {
        $this->assertEquals([
            'files'       => [
                'fileone.txt' => '534ce597146330a289981d255c6a35e1',
            ],
            'directories' => [
                'dirone' => [
                    'files'       => [
                        'filetwo.txt' => 'ed4b9ec118cd32262da1a0c5d940c28e',
                    ],
                    'directories' => [
                        'dirthree' => [
                            'files'       => [],
                            'directories' => [],
                        ],
                        'dirtwo'   => [
                            'files'       => [
                                'filethree.txt' => 'a1a40f84da2ac4d2c40d9413458dcf3d',
                            ],
                            'directories' => [
                                'dirfour' => [
                                    'files'       => [],
                                    'directories' => [],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], Md5::directory(__DIR__ . '/Md5Test'));
    }
}
