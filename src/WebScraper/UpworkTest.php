<?php
namespace Cryslo\WebScraper;

use Cryslo\Core;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/09/2017
 * Time: 11:32
 */
class UpworkTest extends _WebScraper
{
	/** @var bool $baseUrl */
	private $baseUrl = false;

	/** @var array $data */
	private $data = [];

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param       $baseUrl
	 * @param array $args
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function scrap($baseUrl, array $args = [])
	{
		$baseUrl       = 'http://archive-grbj-2.s3-website-us-west-1.amazonaws.com/';
		$this->baseUrl = $baseUrl;
		$html          = $this->getHtmlFromUrl($baseUrl);

		/**
		 *
		 */
		$articles = $this->filterHtml($html, '.record');

		foreach ($articles as $article)
		{
			/**
			 * Extract Author
			 * Only take articles with an author
			 */
			$author = $this->filterHtml($article, '.author > a');
			if (isset($author[0]))
			{
				$author = $this->cleanAuthor($author[0]);
				if ($author == '')
				{
					continue;
				}


				/**
				 * Extract Title
				 */
				$title = $this->filterHtml($article, '.headline > a');
				if (isset($title[0]))
				{
					$title = $this->cleanTitle($title[0]);
				}
				else
				{
					$title = '';
				}

				/**
				 * Extract Article URL
				 */
				$articleUrl = $this->filterHtml($article, '.headline > a');

				/**
				 * Extract Author URL
				 */
				$authorUrl = $this->filterHtml($article, '.author > a');

				$this->addItem($author, $authorUrl, $title, $articleUrl);
			}
		}

		return true;
	}

	/**
	 * @param $str
	 *
	 * @return string
	 */
	private function cleanAuthor($str)
	{
		return trim($str);
	}

	/**
	 * @param $str
	 *
	 * @return string
	 */
	private function cleanTitle($str)
	{
		return trim($str);
	}

	/**
	 * @param $author
	 * @param $authorUrl
	 * @param $title
	 * @param $articleUrl
	 */
	private function addItem($author, $authorUrl, $title, $articleUrl)
	{
		$code = Core\Utils::codify($author);

		/**
		 * Scrap Article Directly
		 */
		$html = $this->getHtmlFromUrl($this->baseUrl, $articleUrl);

		/**
		 * Extract Article Date
		 */
		$articleDate = false;
		$data        = $this->filterHtml($html, '.record .meta .date');
		if (isset($data[0]) && trim($data[0]) != '')
		{
			$articleDate = trim($data[0]);
		}

		$article = [
			'articleTitle' => $title,
			'articleUrl'   => $articleUrl,
			'articleDate'  => $articleDate,
		];

		/**
		 * Second Article
		 */
		if (isset($this->data[$code]))
		{
			$this->data[$code]['authorCount']++;
			$this->data[$code]['articles'][] = $article;
		}

		/**
		 * First Article
		 */
		else
		{
			/**
			 * Scrap the author URL
			 */
			$authorBio           = false;
			$authorTwitterHandle = false;

			$html = $this->getHtmlFromUrl($this->baseUrl, $authorUrl);

			/**
			 * Extract Bio
			 */
			$data = $this->filterHtml($html, '.author-bio .abstract');
			if (isset($data[0]) && trim($data[0]) != '')
			{
				$authorBio = trim($data[0]);
			}

			/**
			 * Extract Twitter Handle
			 */
			$data = $this->filterHtml($html, '.author-bio .abstract a');
			if (isset($data[0]) && trim($data[0]) != '')
			{
				$authorTwitterHandle = trim($data[0]);
			}

			$this->data[$code] = [
				'authorName'          => $author,
				'authorBio'           => $authorBio,
				'authorTwitterHandle' => $authorTwitterHandle,
				'authorCount'         => 1,
				'articles'            => [$article],
			];
		}
	}
}