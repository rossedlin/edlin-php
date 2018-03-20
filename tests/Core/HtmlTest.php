<?php

namespace Cryslo\Core;

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * User: rossedlin
 * Contact: <contact@rossedlin.com>
 *
 * Date: 20/03/18
 * Time: 12:11
 *
 * @covers Html
 *
 * Class HtmlTest
 */
final class HtmlTest extends TestCase
{
    /**
     * Testing Adding Numbers
     */
    public function testSetFormInputSelected()
    {
        $selected = 'selected';
        $none     = '';

        /**
         * Selected
         */
        $this->assertEquals($selected, Html::setFormInputSelected('A', 'A'));
        $this->assertEquals($selected, Html::setFormInputSelected(1, 1));
        $this->assertEquals($selected, Html::setFormInputSelected(true, true));

        /**
         * None
         */
        $this->assertEquals($none, Html::setFormInputSelected('A', 'B'));
        $this->assertEquals($none, Html::setFormInputSelected(1, 2));
        $this->assertEquals($none, Html::setFormInputSelected(true, false));
    }
}