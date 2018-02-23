<?php

use PHPUnit\Framework\TestCase;
use Cryslo\Core\Utils;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 23/02/2017
 * Time: 09:58
 *
 * @covers Utils
 *
 * Class UtilsTest
 */
final class UtilsTest extends TestCase
{
    /**
     * Testing Getting Only Letters
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

        foreach ($correct as $test)
        {
            $this->assertSame($letter, Utils::getOnlyLetters($test));
        }

        /**
         * Test fail values
         */
        $fail = [
            'abcdefghijklmnopqrstuvwxyzBCDEFGHIJKLMNOPQRSTUVWXYZ',
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY',
            '1234567890',
        ];

        foreach ($fail as $test)
        {
            $this->assertNotSame($letter, Utils::getOnlyLetters($test));
        }
    }

    /**
     * Testing Getting Only Numbers
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

        foreach ($correct as $test)
        {
            $this->assertSame($number, Utils::getOnlyNumbers($test));
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

        foreach ($fail as $test)
        {
            $this->assertNotSame($number, Utils::getOnlyNumbers($test));
        }
    }

    /**
     * Testing Starts With
     */
    public function testStartsWith(): void
    {
        $str = 'H39dmUSQCsu3Kc98';

        /**
         * True
         */
        $this->assertTrue(Utils::startsWith($str, 'H'));
        $this->assertTrue(Utils::startsWith($str, 'H39dm'));
        $this->assertTrue(Utils::startsWith($str, 'H3'));

        /**
         * False
         */
        $this->assertFalse(Utils::startsWith($str, 'd236fc7ybu'));
        $this->assertFalse(Utils::startsWith($str, ' H')); //Check space
        $this->assertFalse(Utils::startsWith($str, 'h')); //Check case
        $this->assertFalse(Utils::startsWith($str, '98')); //Check reverse
        $this->assertFalse(Utils::startsWith($str, '98 ')); //Check reverse + space
    }
}