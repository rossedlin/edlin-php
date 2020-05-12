<?php

namespace Edlin\Tests\Core;

use PHPUnit\Framework\TestCase;
use Edlin\Core\View;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 16/02/2017
 * Time: 15:03
 *
 * Class ViewTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Core\View
 */
final class ViewTest extends TestCase
{
    /**
     * @covers \Edlin\Core\View::getHtml
     * @throws \Exception
     */
    public function testHtml()
    {
        $this->assertTrue(View::htmlExists('Test/TestHtml'));
        $this->assertFalse(View::htmlExists('Test/Fail'));

        $file = __DIR__ . '/../../view/Test/TestHtml.html';
        $args = [
            'title'   => md5(time()),
            'content' => md5(time()),
        ];

        /**
         * Render Content & Compare
         */
        $this->assertEquals(View::getHtml('Test/TestHtml', $args), $this->render($file, $args));
        $this->assertNotEquals(View::getHtml('Test/TestHtml'), $this->render($file, $args));
        $this->assertNotEquals(View::getHtml('Test/TestHtml', $args), $this->render($file));

        /**
         * Exceptions
         */
        try {
            $this->assertNotEquals(View::getHtml('Test/1TestHtml', $args), $this->render($file));

            $this->fail("I should of thrown an Exception");
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @covers \Edlin\Core\View::getCss
     * @throws \Exception
     */
    public function testCss()
    {
        $this->assertTrue(View::cssExists('Test/TestCss'));
        $this->assertFalse(View::cssExists('Test/Fail'));

        $file = __DIR__ . '/../../view/Test/TestCss.css';
        $args = [
            'font-size' => time() . 'px',
        ];

        /**
         * Render Content & Compare
         */
        $this->assertEquals(View::getCss('Test/TestCss', $args), $this->render($file, $args));
        $this->assertNotEquals(View::getCss('Test/TestCss'), $this->render($file, $args));
        $this->assertNotEquals(View::getCss('Test/TestCss', $args), $this->render($file));

        /**
         * Exception
         */
        try {
            $this->assertNotEquals(View::getCss('Test/1TestCss', $args), $this->render($file));

            $this->fail("I should of thrown an Exception");
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @param       $file
     * @param array $args
     *
     * @return string
     * @throws \Exception
     */
    private function render($file, array $args = [])
    {
        if (!file_exists($file)) {
            throw new \Exception("Missing Test File: " . $file);
        }

        ob_start();
        require($file);
        $contents = ob_get_contents();

        foreach ($args as $key => $arg) {
            $contents = str_replace('{{' . $key . '}}', $arg, $contents);
        }

        ob_end_clean();

        return (string)$contents;
    }
}
