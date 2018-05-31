<?php

namespace Cryslo\Tests\Core;

use Cryslo\Core\Html;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 20/03/18
 * Time: 12:11
 *
 * Class HtmlTest
 * @package Cryslo\Tests\Core
 * @covers  \Cryslo\Core\Html
 */
final class HtmlTest extends TestCase
{
    /**
     * @covers \Cryslo\Core\Html::setFormInputSelected
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

    /**
     * @covers \Cryslo\Core\Html::setFormInputChecked
     */
    public function testSetFormInputChecked()
    {
        $selected = 'checked';
        $none     = '';

        /**
         * Selected
         */
        $this->assertEquals($selected, Html::setFormInputChecked('A', 'A'));
        $this->assertEquals($selected, Html::setFormInputChecked(1, 1));
        $this->assertEquals($selected, Html::setFormInputChecked(true, true));

        /**
         * None
         */
        $this->assertEquals($none, Html::setFormInputChecked('A', 'B'));
        $this->assertEquals($none, Html::setFormInputChecked(1, 2));
        $this->assertEquals($none, Html::setFormInputChecked(true, false));
    }
}
