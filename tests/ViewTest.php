<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Cryslo\Core\View;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 16/02/2017
 * Time: 15:03
 *
 * @covers View
 *
 * Class ViewTest
 */
final class ViewTest extends TestCase
{
	/**
	 * Testing Html Renderer
	 */
	public function testHtml()
	{
		$this->assertTrue(View::htmlExists('Test/TestHtml'));
		$this->assertFalse(View::htmlExists('Test/Fail'));

		$file = __DIR__ . '/../view/Test/TestHtml.html';
		$args = [
			'title'   => md5(time()),
			'content' => md5(time()),
		];

		$this->assertEquals(View::getHtml('Test/TestHtml', $args), $this->render($file, $args));
	}

	/**
	 * Testing Css Renderer
	 */
	public function testCss()
	{
		$this->assertTrue(View::cssExists('Test/TestCss'));
		$this->assertFalse(View::cssExists('Test/Fail'));

		$file = __DIR__ . '/../view/Test/TestCss.css';
		$args = [
			'font-size' => time() . 'px',
		];

		$this->assertEquals(View::getCss('Test/TestCss', $args), $this->render($file, $args));
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
		try
		{
			if (!file_exists($file))
			{
				throw new \Exception("Missing Test File: " . $file);
			}

			ob_start();
			require($file);
			$contents = ob_get_contents();

			foreach ($args as $key => $arg)
			{
				$contents = str_replace('{{' . $key . '}}', $arg, $contents);
			}

			ob_end_clean();

			return (string)$contents;
		}
		catch (\Exception $e)
		{
			throw $e;
		}

		return "";
	}
}