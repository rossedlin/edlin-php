<?php
namespace Cryslo;

class Utils
{
	static public function isValidTimeStamp($timestamp)
	{
		return ((string) (int) $timestamp === $timestamp) 
			&& ($timestamp <= PHP_INT_MAX)
			&& ($timestamp >= ~PHP_INT_MAX);
	}

	static public function startsWith($haystack, $needle)
	{
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}

	static public function endsWith($haystack, $needle)
	{
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}

	static public function getFromArray(&$array, $key, $default = false)
	{
		if (isset($array[$key]))
		{
			return $array[$key];
		}

		return $default;
	}

	static public function snakeCaseToPascalCase($str)
	{
		return ucfirst(self::snakeCaseToCamelCase($str));
	}

	static public function snakeCaseToCamelCase($str)
	{
		$func = create_function('$c', 'return strtoupper($c[1]);');
		return preg_replace_callback('/_([a-z])/', $func, $str);
	}
}
/*
class Utils
{
	function NotFound()
	{
		header("HTTP/1.1 404 Not Found");
	}
	
	function HasValue(&$string)
	{
		if ((!isset($string)) || (is_bool($string)))
		{
			return "";
		}
		return $string;
	}
	
	function HasValueSelect(&$string)
	{
		if (!isset($string)) return "";
		if ($string == "1") return "checked=\"checked\"";
		return "";
	}

	function DumpVar(&$var)
	{
		print '<pre style="line-height: 120%; font-size: 10px; font-family: Lucida Console; clear: both;">';
		var_dump($var);
		print '</pre>';
	}

	function TruncateString($str, $maxlen)
	{
		if (strlen($str) > $maxlen)
		{
			$text = substr(trim($str), 0, $maxlen);
			$text = substr($text, 0, strlen($text) - strpos(strrev($text), ' '));
			return Array(trim($text), true);
		}
		else
			return Array($str, false);
	}

	function generate_password($length = 8)
	{
		//Create temporary password
		srand ((float) microtime() * 10000000);
		$chars = array(1,2,3,4,5,6,7,8,9,0,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
		$password_keys = array_rand($chars, $length);
		$user_password = '';
		foreach ($password_keys as $k)
			$user_password .= $chars[$k];
		return $user_password;
	}

	function GenerateKey()
	{
		return md5(date('YmdHis').microtime().$_SERVER['REMOTE_ADDR'].$_SERVER['REMOTE_PORT']);
	}

	function FormatValue($a, $prefix = '    ', $indent = '    ', $indentlevel = 0)
	{
		$retval = '';
		if (is_array($a))
		{
			if ($indentlevel > 0)
				$retval .= "Array\n";
			foreach ($a as $key=>$val)
			{
				$retval .= $prefix.str_repeat($indent, $indentlevel).$key.' = ';
				$retval .= Utils::FormatValue($val, $prefix, $indent, $indentlevel + 1);
			}
		}
		else
			$retval .= $a."\n";
		return $retval;
	}

	function FixedLength($str, $length, $padwith = ' ', $alignment = STR_PAD_RIGHT)
	{
		return str_pad(substr($str, 0, $length), $length, $padwith, $alignment);
	}

	function ValidGUID($guid)
	{
		return (strlen($guid) == strlen('00000000-0000-0000-0000-000000000000')
					and
				$guid != '00000000-0000-0000-0000-000000000000');
	}

	function ToURL($text)
	{
		return urlencode(preg_replace(Array('/[^a-zA-Z0-9 +]/', '/ +/'), Array('', '_'), $text));
	}

	function stripos($haystack, $needle, $offset = 0)
	{
		return strpos(strtoupper($haystack), strtoupper($needle), $offset);
	}

	function ParseSearchRequest($str, $combination = 'and')
	{
		$str = trim($str);
		$query = $str;
		while (strpos($str, '  ') !== false)
			$str = str_replace('  ', ' ', $str);

		$str = str_replace(' in ', ' and ', $str);
		$str = str_replace(' near ', ' and ', $str);
		// Replace 'in' and 'near' with 'and'
		if (Utils::stripos($str, ' and ') === false and
			Utils::stripos($str, ' or ') === false)
				$str = str_replace(' ', ' and ', $str);

		$bits = split(' and ', $str);
		//Utils::DumpVar($bits);
		$str = '';
		foreach ($bits as $key=>$bit)
		{
			if (Utils::stripos($bit, ' or ') !== false)
			{
				$orbits = split(' or ', $bit);
				foreach ($orbits as $orkey=>$orbit)
				{
					//print $orbit.'<br />';
					if (strpos($orbit, ' ') === false)
					{
						if (substr($orbit, -1) == 's')
							$orbits[$orkey] = '("'.substr($orbit, 0, -1).'" or "'.$orbit.'")';
						else
							$orbits[$orkey] = '("'.$orbit.'" or "'.$orbit.'s")';
					}
					else
						$orbits[$orkey] = '"'.$orbit.'"';
				}
				$bits[$key] = '('.join(' or ', $orbits).')';
			}
			else
			{
				if (strpos($bit, ' ') === false)
				{
					if (substr($bit, -1) == 's')
						$bits[$key] = '("'.substr($bit, 0, -1).'" or "'.$bit.'")';
					else
						$bits[$key] = '("'.$bit.'" or "'.$bit.'s")';
				}
				else
					$bits[$key] = '"'.$bit.'"';
			}
		}
		$str = join(' '.$combination.' ', $bits);

		while (strpos($str, '""') !== false)
			$str = str_replace('""', '"', $str);
		//print '<p>'.$str.'</p>';
		$str = '("'.$query.'" or ('.$str.'))';
		return $str;
	}

	function GetSearchTerms($str, $combination = 'and')
	{
		$str = Utils::ParseSearchRequest($str);
		$terms = split(' and | or ', $str);
		$retval = Array();
		foreach ($terms as $term)
		{
			$term = trim(preg_replace('/([\"\(\)])/', '', $term));
			if (!in_array($term, $retval))
				$retval[] = $term;
		}
		return $retval;
	}

	function Highlight($data, $terms)
	{
		$data = '>'.$data.'<';
		foreach ($terms as $term)
		{
			//$data = preg_replace('/((?=>)[^<]*?[^\w])('.preg_quote($term).')([^\w][^<>]*)/i', '\\1<span class="highlight">\\2</span>\\3', $data);
			$data = preg_replace('/('.preg_quote($term).')/i', '<span class="highlight">\\1</span>', $data);
			while (preg_match('/(<[^>]+)<span class=\"highlight\">('.preg_quote($term).')<\/span>([^<]+)/i', $data) > 0)
				$data = preg_replace('/(<[^>]+)<span class=\"highlight\">('.preg_quote($term).')<\/span>([^<]+)/i', '\\1\\2\\3', $data);
		}
		$data = substr($data, 1, strlen($data)-2);
		return $data;
	}

	function GetMonthArray($year, $month)
	{
		$retval = Array();
		for ($i = 1; $i <= 7; $i++)
			for ($j = 1; $j <= 7; $j++)
				$retval[$i][$j] = '&nbsp;';

		$offset = intval(date('w', strtotime($year.'-'.$month.'-01')));
		$offset += 7;
		$daysinmonth = date('t', strtotime($year.'-'.$month.'-01'));

		for ($i = 1; $i <= $daysinmonth; $i++)
		{
			$retval[($offset/7)][($offset%7)+1] = $i;
			$offset++;
		}

		foreach ($retval as $key=>$val)
		{
			if (strlen(trim(str_replace('&nbsp;', '', join('', $val)))) == 0)
				unset($retval[$key]);
			else
				ksort($retval[$key]);
		}
		return $retval;
	}
	
	function NewLineToBreakTag($vText)
	{
		if (is_array($vText))
		{
		   foreach ($vText as $sKey=>$sVal)

			{
				$vText[$sKey] = preg_replace("(\r\n|\n|\r)","<BR />",$vText[$sKey]);

			}
		}
		else
		{
			$vText = preg_replace("(\r\n|\n|\r)","<BR />",$vText);
		}

		return $vText;

	}
	
	function CreateGuid()
	{
		//global $DB;
		//$sql = "SELECT CONVERT(VARCHAR(36), NEWID()) as newguid";
		//return $DB->GetSingleValue($sql,'newguid');
	}

}
*/
?>