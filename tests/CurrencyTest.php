<?php

namespace Edlin\Tests;

use Edlin\Currency\Currency;
use PHPUnit\Framework\TestCase;

final class CurrencyTest extends TestCase
{
    /**
     *
     */
    public function testConvertCodeToSymbol()
    {
        $this->assertEquals(null, Currency::convertCodeToSymbol('gbp'));
        $this->assertEquals('£', Currency::convertCodeToSymbol('GBP'));
        $this->assertEquals('$', Currency::convertCodeToSymbol('USD'));
        $this->assertEquals('€', Currency::convertCodeToSymbol('EUR'));
    }
}
