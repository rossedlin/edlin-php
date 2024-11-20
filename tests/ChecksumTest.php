<?php

namespace Edlin\Tests;

use Edlin\Checksum;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 18/09/2021
 * Time: 20:18
 *
 * @covers  \Edlin\Checksum
 */
final class ChecksumTest extends TestCase
{
    /**
     * @covers \Edlin\Checksum::directory
     */
    public function testDirectoryBlank()
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
                        'dirtwo'   => [
                            'files'       => [
                                'filethree.txt' => [],
                            ],
                            'directories' => [],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, Checksum::directory(__DIR__ . '/Md5Test'));
    }

    /**
     * @covers \Edlin\Checksum::directory
     */
    public function testDirectoryFilesize()
    {
        $expected = [
            'files'       => [
                'fileone.txt' => [
                    'filesize' => 7,
                ],
            ],
            'directories' => [
                'dirone' => [
                    'files'       => [
                        'filetwo.txt' => [
                            'filesize' => 8,
                        ],
                    ],
                    'directories' => [
                        'dirtwo'   => [
                            'files'       => [
                                'filethree.txt' => [
                                    'filesize' => 11,
                                ],
                            ],
                            'directories' => [],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, Checksum::directory(__DIR__ . '/Md5Test', [
            'filesize' => true,
        ]));
    }

    /**
     * @covers \Edlin\Checksum::directory
     */
    public function testDirectoryMd5Filename()
    {
        $expected = [
            'files'       => [
                'fileone.txt' => [
                    'md5_filename' => '56e0225c00de27da1df1ee61c2004ba1',
                ],
            ],
            'directories' => [
                'dirone' => [
                    'files'       => [
                        'filetwo.txt' => [
                            'md5_filename' => '3853aeff963687e9aedd1e45c03439fe',
                        ],
                    ],
                    'directories' => [
                        'dirtwo'   => [
                            'files'       => [
                                'filethree.txt' => [
                                    'md5_filename' => 'bcaa95c385d6e7947707c4c5543c4556',
                                ],
                            ],
                            'directories' => [],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals('56e0225c00de27da1df1ee61c2004ba1', md5('fileone.txt'));
        $this->assertEquals('3853aeff963687e9aedd1e45c03439fe', md5('filetwo.txt'));
        $this->assertEquals('bcaa95c385d6e7947707c4c5543c4556', md5('filethree.txt'));
        $this->assertEquals($expected, Checksum::directory(__DIR__ . '/Md5Test', [
            'md5_filename' => true,
        ]));
    }

    /**
     * @covers \Edlin\Checksum::directory
     */
    public function testDirectoryMd5File()
    {
        $expected = [
            'files'       => [
                'fileone.txt' => [
                    'md5_file' => '2de62a90cdf853a8653407223ae3e565',
                ],
            ],
            'directories' => [
                'dirone' => [
                    'files'       => [
                        'filetwo.txt' => [
                            'md5_file' => 'a5f30764b2b1a5dce89d760ca391e024',
                        ],
                    ],
                    'directories' => [
                        'dirtwo'   => [
                            'files'       => [
                                'filethree.txt' => [
                                    'md5_file' => 'e6817a2e8231c241ea2509670c941a96',
                                ],
                            ],
                            'directories' => [],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals('2de62a90cdf853a8653407223ae3e565', md5_file(__DIR__ . '/Md5Test/fileone.txt'));
        $this->assertEquals('a5f30764b2b1a5dce89d760ca391e024', md5_file(__DIR__ . '/Md5Test/dirone/filetwo.txt'));
        $this->assertEquals('e6817a2e8231c241ea2509670c941a96', md5_file(__DIR__ . '/Md5Test/dirone/dirtwo/filethree.txt'));
        $this->assertEquals($expected, Checksum::directory(__DIR__ . '/Md5Test', [
            'md5_file' => true,
        ]));
    }
}
