<?php
namespace Cryslo\Object\WordPress;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 25/09/2017
 * Time: 18:46
 *
 * Class Author
 *
 * @package Cryslo\Object\WordPress
 */
class User
{
	/**
	 * Avatar sizes
	 */
	const AVATAR_24 = 24;
	const AVATAR_48 = 48;
	const AVATAR_96 = 96;

	/** @var int $id */
	private $id;

	/** @var string $name */
	private $displayName = "";

	/** @var string $description */
	private $description = "";

	/** @var array */
	private $avatar = [];

	/** @var string $email */
	private $email = "";

	/** @var string $googlePlus */
	private $googlePlus = "";

	/** @var string $facebook */
	private $facebook = "";

	/** @var string $twitter */
	private $twitter = "";

	/** @var string $linkedin */
	private $linkedin = "";

	/** @var string $instagram */
	private $instagram = "";

	/** @var string $github */
	private $github = "";

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = (int)$id;
	}

	/**
	 * @return string
	 */
	public function getDisplayName()
	{
		return $this->displayName;
	}

	/**
	 * @param string $displayName
	 */
	public function setDisplayName($displayName)
	{
		$this->displayName = $displayName;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * @param int $size
	 * @param string $default
	 *
	 * @return mixed|string
	 */
	public function getAvatar($size, $default = '')
	{
		if (isset($this->avatar[$size]))
		{
			return $this->avatar[$size];
		}

		return $default;
	}

	/**
	 * @param array $avatar
	 */
	public function setAvatar(array $avatar)
	{
		$this->avatar = $avatar;
	}

	/**
	 * @param $key
	 * @param $url
	 */
	public function addAvatar($key, $url)
	{
		$this->avatar[$key] = $url;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getGooglePlus()
	{
		return $this->googlePlus;
	}

	/**
	 * @param string $googlePlus
	 */
	public function setGooglePlus($googlePlus)
	{
		$this->googlePlus = $googlePlus;
	}

	/**
	 * @return string
	 */
	public function getFacebook()
	{
		return $this->facebook;
	}

	/**
	 * @param string $facebook
	 */
	public function setFacebook($facebook)
	{
		$this->facebook = $facebook;
	}

	/**
	 * @return string
	 */
	public function getTwitter()
	{
		return $this->twitter;
	}

	/**
	 * @param string $twitter
	 */
	public function setTwitter($twitter)
	{
		$this->twitter = $twitter;
	}

	/**
	 * @return string
	 */
	public function getLinkedin()
	{
		return $this->linkedin;
	}

	/**
	 * @param string $linkedin
	 */
	public function setLinkedin($linkedin)
	{
		$this->linkedin = $linkedin;
	}

	/**
	 * @return string
	 */
	public function getInstagram()
	{
		return $this->instagram;
	}

	/**
	 * @param string $instagram
	 */
	public function setInstagram($instagram)
	{
		$this->instagram = $instagram;
	}

	/**
	 * @return string
	 */
	public function getGithub()
	{
		return $this->github;
	}

	/**
	 * @param string $github
	 */
	public function setGithub($github)
	{
		$this->github = $github;
	}
}