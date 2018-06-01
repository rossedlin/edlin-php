<?php

namespace Cryslo\Tests\Core;

use PHPUnit\Framework\TestCase;
use Cryslo\Core\Xml;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 01/06/18
 * Time: 18:03
 *
 * Class XmlTest
 * @package Cryslo\Tests\Core
 * @covers  \Cryslo\Core\Xml
 */
final class XmlTest extends TestCase
{
    /**
     * @covers \Cryslo\Core\Xml::simpleToArray
     *
     * @throws \Exception
     */
    public function testSimpleToArray()
    {
        $this->assertEquals(
            require_once(__DIR__ . '/../../xml/test/simple.php'),
            Xml::simpleToArray(file_get_contents(__DIR__ . '/../../xml/test/simple.xml'))
        );
    }

    /**
     * @covers \Cryslo\Core\Xml::soapToArray
     *
     * @throws \Exception
     */
    public function testSoapToArray()
    {
        $this->assertEquals(
            require_once(__DIR__ . '/../../xml/test/soap.php'),
            Xml::soapToArray(file_get_contents(__DIR__ . '/../../xml/test/soap.xml'))
        );
    }
}
