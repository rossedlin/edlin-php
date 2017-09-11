<?php
namespace Cryslo\WebScraper;

use GuzzleHttp\Client;
//use GuzzleHttp\Exception;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/09/2017
 * Time: 11:30
 */
abstract class _WebScraper
{
	/**
	 * @param string $baseUrl
	 * @param array  $args
	 *
	 * @return string
	 * @throws \Exception
	 */
	abstract public function scrap($baseUrl, array $args = []);

	/**
	 * @param        $baseUrl
	 * @param string $subUrl
	 *
	 * @return string
	 */
	protected static function getHtmlFromUrl($baseUrl, $subUrl = '/')
	{
		$client = new Client([
			'base_uri' => $baseUrl,
			'timeout'  => 5.0,
		]);

		/**
		 * Request HTML
		 */
		$response = $client->request('GET', $subUrl);
		$body     = $response->getBody();
		$html     = $body->getContents();

		return $html;
	}

	/**
	 * @param $html
	 * @param $filter
	 *
	 * @return array
	 */
	protected static function filterHtml($html, $filter)
	{
		try
		{
			$crawler  = new Crawler($html);
			$articles = $crawler
				->filter($filter)
				->each(function (Crawler $node)
				{
					return $node->html();
				});

			return $articles;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}

	/**
	 * @param $html
	 * @param $filter
	 *
	 * @return array
	 */
	protected static function filterHref($html, $filter)
	{
		try
		{
			$crawler = new Crawler($html);
			$link    = $crawler->filter($filter)->attr('href');
			return $link;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}
}