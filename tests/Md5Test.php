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
        $expected = [
            'files'       => [
                'fileone.txt' => '2de62a90cdf853a8653407223ae3e565',
            ],
            'directories' => [
                'dirone' => [
                    'files'       => [
                        'filetwo.txt' => 'a5f30764b2b1a5dce89d760ca391e024',
                    ],
                    'directories' => [
                        'dirthree' => [
                            'files'       => [],
                            'directories' => [],
                        ],
                        'dirtwo'   => [
                            'files'       => [
                                'filethree.txt' => 'e6817a2e8231c241ea2509670c941a96',
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
        ];

        $this->assertEquals($expected, Md5::directory(__DIR__ . '/Md5Test'));
        $this->assertEquals($expected, Md5::directory(__DIR__ . '/Md5Test', 'php'));
        $this->assertEquals($expected, Md5::directory(__DIR__ . '/Md5Test', 'system_md5sum'));
    }
}
