<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 08/02/2017
 * Time: 11:38
 */
class Config
{
	const EXAMPLE_SECRET = 'secret';

	/**
	 * @var \stdClass $data
	 */
	private static $data = false;

	/**
	 * @return mixed|\stdClass
	 */
	public static function getAll()
	{
		try
		{
			/**
			 * If file does not exist we need to generate one
			 * Using the example file
			 */
			self::_generate();

			/**
			 * Get Real
			 */
			return self::_getReal();
		}
		catch (\Exception $e)
		{
			Log::write($e);
		}

		return new \stdClass();
	}

	/**
	 * @param      $key
	 * @param bool $default
	 *
	 * @return bool
	 */
	public static function get($key, $default = false)
	{
		/**
		 * Retrieve data from config file
		 */
		if (self::$data === false)
		{
			self::$data = self::getAll();
		}

		/**
		 * Check if data isset
		 * Return if success
		 */
		if (isset(self::$data->$key))
		{
			return self::$data->$key;
		}

		return $default;
	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return Object\Response
	 */
	public static function set($key, $value)
	{
		/**
		 * Retrieve data from config file
		 */
		if (self::$data === false)
		{
			self::$data = self::getAll();
		}

		self::$data->$key = $value;

		return File::write(self::_getRealJsonFile(), json_encode(self::$data, JSON_PRETTY_PRINT));
	}

	/**
	 * @return mixed
	 *
	 * @throws \Exception
	 */
	private static function _generate()
	{
		/**
		 * Extract Data
		 */
		$example = self::_getExample();
		$real    = self::_getReal();

		/**
		 * Flick through the example data
		 * If the data in the real data is missing, populate it with the example data
		 */
		$writeNewReal = false;
		foreach ($example as $eK => &$eV)
		{
			if (isset($real->$eK)) continue;
			$writeNewReal = true;

			switch ($eV)
			{
				case self::EXAMPLE_SECRET:
					$eV = md5(rand());
					break;
			}

			$real->$eK = $eV;
		}

		if ($writeNewReal)
		{
			File::write(self::_getRealJsonFile(), json_encode($real, JSON_PRETTY_PRINT));
		}
	}

	/**
	 * @return \stdClass
	 */
	private static function _getReal()
	{
		try
		{
			$raw  = File::read(self::_getRealJsonFile());
			$data = json_decode($raw);

			if (!($data instanceof \stdClass))
			{
				throw new \Exception("Json Config no instance of stdClass");
			}

			return $data;
		}
		catch (\Exception $e)
		{
			Log::write($e->getMessage());
		}

		return new \stdClass();
	}

	/**
	 * @return \stdClass
	 * @throws \Exception
	 */
	private static function _getExample()
	{
		/**
		 * If the example has a problem, we got a SERIOUS issue
		 * So throw a proper error
		 *
		 * @var \stdClass $data
		 */
		$raw  = File::read(self::_getExampleJsonFile());
		$data = json_decode($raw);

		if (!($data instanceof \stdClass))
		{
			throw new \Exception("Json Config no instance of stdClass");
		}

		return $data;
	}

	/**
	 * @return string
	 */
	private static function _getRealJsonFile()
	{
		return __DIR__ . '/../../../../cryslo_core.json';
	}

	/**
	 * @return string
	 */
	private static function _getExampleJsonFile()
	{
		return __DIR__ . '/../config/cryslo.example.json';
	}
}