<?php

namespace Edlin\Tests;

use Edlin\Arr;
use Edlin\Directory;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 09/02/2017
 * Time: 12:10
 *
 * Class StrTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Arr
 */
final class DirectoryTest extends TestCase
{
    /**
     * @covers \Edlin\Arr::keyBy
     * @throws Exception
     */
    public function testGetContents()
    {
        $this->assertEquals([
            'files'       => [
                'fileone.txt',
            ],
            'directories' => [
                'dirone' => [
                    'files'       => [
                        'filetwo.txt',
                    ],
                    'directories' => [
                        'dirthree' => [
                            'files'       => [],
                            'directories' => [],
                        ],
                        'dirtwo'   => [
                            'files'       => [
                                'filethree.txt',
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
        ], Directory::getContents(__DIR__ . '/DirectoryTest'));
    }
}
