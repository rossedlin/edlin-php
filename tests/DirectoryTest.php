<?php

namespace Edlin\Tests;

use Edlin\Directory;
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
 * Class DirectoryTest
 * @covers  \Edlin\Directory
 */
final class DirectoryTest extends TestCase
{
    /**
     * @covers \Edlin\Directory::getContents
     */
    public function testGetContents()
    {
        $expected = [
            'files'       => [
                'fileone.txt' => [],
            ],
            'directories' => [
                'dirone' => [
                    'files'       => [
                        'filetwo.txt' => [],
                    ],
                    'directories' => [
                        'dirthree' => [
                            'files'       => [
                                'filethree.txt' => [],
                            ],
                            'directories' => [],
                        ],
                        'dirtwo'   => [
                            'files'       => [
                                'filethree.txt' => [],
                            ],
                            'directories' => [
                                'dirfour' => [
                                    'files'       => [
                                        'filefour.txt' => [],
                                    ],
                                    'directories' => [],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $actual = Directory::getContents(__DIR__ . '/DirectoryTest');

        $this->assertEquals($expected, $actual);
    }
}
