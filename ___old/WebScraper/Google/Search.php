<?php
namespace Cryslo\WebScraper\Google;

use Cryslo\WebScraper;
use Cryslo\Core;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/09/2017
 * Time: 12:05
 */
class Search extends WebScraper\_WebScraper
{
	//https://www.google.co.uk/search?q=Ross+Edlin

	/**
	 * @param string $baseUrl
	 * @param array  $args
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function scrap($baseUrl, array $args = [])
	{
		if (!$this->isBaseUrlValid($baseUrl))
		{
			throw new \Exception('Base URL is not Valid: ' . $baseUrl);
		}

		/**
		 * Args
		 */
		$subUrl = Core\Request::getFromArray($args, 'subUrl', '/');

		/**
		 *
		 */
		$return        = [];
		$html          = $this->getHtmlFromUrl($baseUrl, $subUrl);
		$searchResults = $this->filterHtmlArray($html, '#search .g');

		/**
		 * Filter each search result
		 */
		foreach ($searchResults as $searchResult)
		{
			$return[] = [
				'title'       => $this->extractTitle($searchResult),
				'href'        => $this->extractHref($searchResult),
				'description' => $this->extractDescription($searchResult),
			];
		}

		return $return;
	}

	/**
	 * @param $baseUrl
	 *
	 * @return bool
	 */
	private function isBaseUrlValid($baseUrl)
	{
		if ($baseUrl == 'https://www.google.co.uk/')
		{
			return true;
		}

		return false;
	}

	/**
	 * @param $html
	 *
	 * @return string
	 */
	private function extractTitle($html)
	{
		try
		{
			return trim(strip_tags($this->filterHtmlSingle($html, 'h3 a')));
		}
		catch (\Exception $e)
		{
			return "";
		}
	}

	/**
	 * @param $html
	 *
	 * @return string
	 */
	private function extractHref($html)
	{
		try
		{
			return trim(strip_tags($this->filterHtmlSingle($html, '.kv cite')));
		}
		catch (\Exception $e)
		{
			return "";
		}
	}

	/**
	 * @param $html
	 *
	 * @return string
	 */
	private function extractDescription($html)
	{
		try
		{
			return trim(strip_tags($this->filterHtmlSingle($html, '.st')));
		}
		catch (\Exception $e)
		{
			return "";
		}
	}

	/**
	 * @param $str
	 *
	 * @return mixed
	 */
	public static function searchify($str)
	{
		$str = strip_tags($str);
		$str = strtolower($str);

		$str = str_replace(' ', '+', $str);
		$str = Core\Utils::replaceMultipleWithOne($str, '+', '+');

		return $str;
	}
}