<?php

namespace Edlin\Tests;

use Edlin\Str;
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
 * @covers  \Edlin\Core\Str
 */
final class StrTest extends TestCase
{
    /**
     * @covers \Edlin\Core\Str::cacheFriendlyKey
     */
    public function testCacheFriendlyKey()
    {
        $this->assertEquals('2018-9', Str::cacheFriendlyKey('2018/9'));
        $this->assertEquals('act.something.2018-9', Str::cacheFriendlyKey('act.something.2018/9'));
        $this->assertEquals('act.something.2018-9', Str::cacheFriendlyKey('$$$/act.something.2018/9'));
        $this->assertEquals('u-act.something.2018-9', Str::cacheFriendlyKey('u$$$/act.something.2018/9'));
        $this->assertEquals(
            'u-act.some-thing.20-18-9',
            Str::cacheFriendlyKey('u$$$/act.some$&^%*^thing.20£$&^@18/9')
        );
        $this->assertEquals(
            'u-act.so-me-thing.20-18-9',
            Str::cacheFriendlyKey('u$$$/act.so_me$&^%*^thing.20£$&^@18/9')
        );
    }

    /**
     * @covers \Edlin\Core\Str::codify
     */
    public function testCodify()
    {
        $this->assertEquals(
            '2018-934-34-f3-g34820h9n2mc22f-g4',
            Str::codify('2018/934.;][34-f3,[g34820h9n2mc22f.[g4')
        );

        $this->assertEquals(
            'bfnm-3-f0c083gb4n-8736g',
            Str::codify('[]%*(%(BFNM<{.3[f0c083gb4n.\'@}{>8736g}')
        );
    }

    /**
     * @covers \Edlin\Core\Str::endsWith
     */
    public function testEndsWith()
    {
        $str = 'H39dmUSQCsu3Kc98';

        /**
         * True
         */
        $this->assertTrue(Str::endsWith($str, '98'));
        $this->assertTrue(Str::endsWith($str, '3Kc98'));
        $this->assertTrue(Str::endsWith($str, 'USQCsu3Kc98'));

        /**
         * False
         */
        $this->assertFalse(Str::endsWith($str, 'QCsu3Kc98 ')); //Check space
        $this->assertFalse(Str::endsWith($str, '3KC98')); //Check case
        $this->assertFalse(Str::endsWith($str, 'H39')); //Check reverse
        $this->assertFalse(Str::endsWith($str, ' H39')); //Check reverse + space
    }

    /**
     * @covers \Edlin\Core\Str::getOnlyLetters
     */
    public function testGetOnlyLetters()
    {
        $letter = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        /**
         * Test correct values
         */
        $correct = [
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'a1bcdef2ghijklmnopqr5stuvwxyzA7BCDEFGH9IJKLMNO0PQRSTUV-WXYZ',
            'a1bcdef2586%**(67ghijk58689%*(lmnopqr5stuvwxyzA7BCDE896%*FGH9IJKLMNO0PQ%*87568%RSTUV-WXYZ',
        ];

        foreach ($correct as $test) {
            $this->assertSame($letter, Str::getOnlyLetters($test));
        }

        /**
         * Test fail values
         */
        $fail = [
            'abcdefghijklmnopqrstuvwxyzBCDEFGHIJKLMNOPQRSTUVWXYZ',
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY',
            '1234567890',
        ];

        foreach ($fail as $test) {
            $this->assertNotSame($letter, Str::getOnlyLetters($test));
        }
    }

    /**
     * @covers \Edlin\Core\Str::getOnlyNumbers
     */
    public function testGetOnlyNumbers()
    {
        $number = '123456789';

        /**
         * Test correct values
         */
        $correct = [
            '123456789',
            '123.45.67.89',
            ' 1 2 3 4 5 6 7 8 9 ',
            ' a1 b2 c3 d4 e5 f6 g7 h8 i9 ',
            ' ^(&a1 b%^*^2 c3 d^(4 e5 ^&(&f6 g%*%^7 h^(&*8 i9 ',
        ];

        foreach ($correct as $test) {
            $this->assertSame($number, Str::getOnlyNumbers($test));
        }

        /**
         * Test fail values
         */
        $fail = [
            '0123456789',
            '12345678910',
            '44893t3448',
            'g45y2h252',
            'wegherhwer',
            '4489.[45y.[453t3448',
        ];

        foreach ($fail as $test) {
            $this->assertNotSame($number, Str::getOnlyNumbers($test));
        }
    }

    /**
     * @covers \Edlin\Core\Str::replaceMultipleWithOne
     * @throws \Exception
     */
    public function testReplaceMultipleWithOne()
    {
        $this->assertEquals(
            'ab££c',
            Str::replaceMultipleWithOne('ab     c', ' ', '££')
        );

        $this->assertEquals(
            'ab££c',
            Str::replaceMultipleWithOne('ab++++++c', '+', '££')
        );

        $this->assertEquals(
            'abd',
            Str::replaceMultipleWithOne('abcccc', 'c', 'd')
        );

        $this->assertEquals(
            'ab2',
            Str::replaceMultipleWithOne('ab111', '1', '2')
        );

        $this->assertEquals(
            'ab111',
            Str::replaceMultipleWithOne('ab111', '3', '2')
        );
    }

    /**
     * @covers \Edlin\Core\Str::startsWith
     */
    public function testStartsWith()
    {
        $str = 'H39dmUSQCsu3Kc98';

        /**
         * True
         */
        $this->assertTrue(Str::startsWith($str, 'H'));
        $this->assertTrue(Str::startsWith($str, 'H39dm'));
        $this->assertTrue(Str::startsWith($str, 'H3'));

        /**
         * False
         */
        $this->assertFalse(Str::startsWith($str, 'd236fc7ybu'));
        $this->assertFalse(Str::startsWith($str, ' H')); //Check space
        $this->assertFalse(Str::startsWith($str, 'h')); //Check case
        $this->assertFalse(Str::startsWith($str, '98')); //Check reverse
        $this->assertFalse(Str::startsWith($str, '98 ')); //Check reverse + space
    }
}
