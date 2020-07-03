<?php

namespace Edlin\Tests;

use Edlin\Xml;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 01/06/18
 * Time: 18:03
 *
 * Class XmlTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Xml
 */
final class XmlTest extends TestCase
{
    /**
     * @covers \Edlin\Xml::simpleToArray
     *
     * @throws \Exception
     */
    public function testSimpleToArray()
    {
        $this->assertEquals(
            require_once(__DIR__ . '/../xml/test/simple.php'),
            Xml::simpleToArray(file_get_contents(__DIR__ . '/../xml/test/simple.xml'))
        );
    }

    /**
     * @covers \Edlin\Xml::soapToArray
     *
     * @throws \Exception
     */
    public function testSoapToArray()
    {
        $this->assertEquals(
            require_once(__DIR__ . '/../xml/test/soap.php'),
            Xml::soapToArray(file_get_contents(__DIR__ . '/../xml/test/soap.xml'))
        );
    }
}
