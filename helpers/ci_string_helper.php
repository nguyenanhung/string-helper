<?php
/**
 * Project string-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/22/2021
 * Time: 17:42
 */
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package      CodeIgniter
 * @author       EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license      http://opensource.org/licenses/MIT	MIT License
 * @link         https://codeigniter.com
 * @since        Version 1.0.0
 * @filesource
 */
/**
 * CodeIgniter String Helpers
 *
 * @package        CodeIgniter
 * @subpackage     Helpers
 * @category       Helpers
 * @author         EllisLab Dev Team
 * @link           https://codeigniter.com/user_guide/helpers/string_helper.html
 */

// ------------------------------------------------------------------------

if (!function_exists('trim_slashes')) {
	/**
	 * Trim Slashes
	 *
	 * Removes any leading/trailing slashes from a string:
	 *
	 * /this/that/theother/
	 *
	 * becomes:
	 *
	 * this/that/theother
	 *
	 * @param string
	 *
	 * @return    string
	 * @todo          Remove in version 3.1+.
	 * @deprecated    3.0.0    This is just an alias for PHP's native trim()
	 *
	 */
	function trim_slashes($str)
	{
		return trim($str, '/');
	}
}

// ------------------------------------------------------------------------

if (!function_exists('strip_slashes')) {
	/**
	 * Strip Slashes
	 *
	 * Removes slashes contained in a string or in an array
	 *
	 * @param mixed    string or array
	 *
	 * @return    array|string    string or array
	 */
	function strip_slashes($str)
	{
		if (!is_array($str)) {
			return stripslashes($str);
		}

		foreach ($str as $key => $val) {
			$str[$key] = strip_slashes($val);
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

if (!function_exists('strip_quotes')) {
	/**
	 * Strip Quotes
	 *
	 * Removes single and double quotes from a string
	 *
	 * @param string
	 *
	 * @return    string
	 */
	function strip_quotes($str)
	{
		return str_replace(array('"', "'"), '', $str);
	}
}

// ------------------------------------------------------------------------

if (!function_exists('quotes_to_entities')) {
	/**
	 * Quotes to Entities
	 *
	 * Converts single and double quotes to entities
	 *
	 * @param string
	 *
	 * @return    string
	 */
	function quotes_to_entities($str)
	{
		return str_replace(array("\'", "\"", "'", '"'), array("&#39;", "&quot;", "&#39;", "&quot;"), $str);
	}
}

// ------------------------------------------------------------------------

if (!function_exists('reduce_double_slashes')) {
	/**
	 * Reduce Double Slashes
	 *
	 * Converts double slashes in a string to a single slash,
	 * except those found in http://
	 *
	 * http://www.some-site.com//index.php
	 *
	 * becomes:
	 *
	 * http://www.some-site.com/index.php
	 *
	 * @param string
	 *
	 * @return    string
	 */
	function reduce_double_slashes($str)
	{
		return preg_replace('#(^|[^:])//+#', '\\1/', $str);
	}
}

// ------------------------------------------------------------------------

if (!function_exists('reduce_multiples')) {
	/**
	 * Reduce Multiples
	 *
	 * Reduces multiple instances of a particular character.  Example:
	 *
	 * Fred, Bill,, Joe, Jimmy
	 *
	 * becomes:
	 *
	 * Fred, Bill, Joe, Jimmy
	 *
	 * @param string
	 * @param string    the character you wish to reduce
	 * @param bool    TRUE/FALSE - whether to trim the character from the beginning/end
	 *
	 * @return    string
	 */
	function reduce_multiples($str, $character = ',', $trim = false)
	{
		$str = preg_replace('#' . preg_quote($character, '#') . '{2,}#', $character, $str);

		return ($trim === true) ? trim($str, $character) : $str;
	}
}

// ------------------------------------------------------------------------

if (!function_exists('random_string')) {
	/**
	 * Creates a random string of characters
	 *
	 * From FuelPHP
	 *
	 * @param string $type the type of string
	 * @param int $length the number of characters
	 *
	 * @return  string  the random string
	 */
	function random_string($type = 'alnum', $length = 16)
	{
		switch ($type) {
			case 'basic':
				return mt_rand();
				break;

			default:
			case 'alnum':
			case 'numeric':
			case 'nozero':
			case 'alpha':
			case 'distinct':
			case 'hexdec':
				switch ($type) {
					case 'alpha':
						$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;

					default:
					case 'alnum':
						$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;

					case 'numeric':
						$pool = '0123456789';
						break;

					case 'nozero':
						$pool = '123456789';
						break;

					case 'distinct':
						$pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
						break;

					case 'hexdec':
						$pool = '0123456789abcdef';
						break;
				}

				$str = '';
				for ($i = 0; $i < $length; $i++) {
					$str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
				}

				return $str;
				break;

			case 'md5':
			case 'unique':
				return md5(uniqid(mt_rand(), true));
				break;
			case 'base64':
				return base64_encode(md5(uniqid(mt_rand(), true)));
				break;
			case 'sha1' :
				return sha1(uniqid(mt_rand(), true));
				break;
			case 'sha256' :
				return hash('sha256', uniqid(mt_rand(), true));
				break;
			case 'sha384' :
				return hash('sha384', uniqid(mt_rand(), true));
				break;
			case 'sha512' :
				return hash('sha512', uniqid(mt_rand(), true));
				break;
			case 'whirlpool' :
				return hash('whirlpool', uniqid(mt_rand(), true));
				break;
			case 'uuid':
				$pool = array('8', '9', 'a', 'b');

				return sprintf('%s-%s-4%s-%s%s-%s',
					random_string('hexdec', 8),
					random_string('hexdec', 4),
					random_string('hexdec', 3),
					$pool[array_rand($pool)],
					random_string('hexdec', 3),
					random_string('hexdec', 12)
				);
				break;
			case 'binary':
				if (function_exists('random_bytes')) {
					try {
						return random_bytes($length);
					} catch (\Exception $exception) {
						return null;
					}
				} else {
					return null;
				}
				break;
			case 'hex':
			case 'crypto':
				if ($length % 2 !== 0) {
					throw new InvalidArgumentException('You must set an even number to the second parameter when you use `crypto`.');
				}
				if (function_exists('random_bytes')) {
					try {
						return bin2hex(random_bytes($length / 2));
					} catch (\Exception $exception) {
						return null;
					}
				} else {
					return null;
				}
				break;
		}
	}
}

// ------------------------------------------------------------------------

if (!function_exists('increment_string')) {
	/**
	 * Add's _1 to a string or increment the ending number to allow _2, _3, etc
	 *
	 * @param string $str required
	 * @param string $separator What should the duplicate number be appended with
	 * @param string|int $first Which number should be used for the first dupe increment
	 *
	 * @return    string
	 */
	function increment_string($str, $separator = '_', $first = 1)
	{
		preg_match('/(.+)' . preg_quote($separator, '/') . '([0-9]+)$/', $str, $match);

		return isset($match[2]) ? $match[1] . $separator . ($match[2] + 1) : $str . $separator . $first;
	}
}

// ------------------------------------------------------------------------

if (!function_exists('alternator')) {
	/**
	 * Alternator
	 *
	 * Allows strings to be alternated. See docs...
	 *
	 * @param string (as many parameters as needed)
	 *
	 * @return    string
	 */
	function alternator()
	{
		static $i;

		if (func_num_args() === 0) {
			$i = 0;

			return '';
		}

		$args = func_get_args();

		return $args[($i++ % count($args))];
	}
}

// ------------------------------------------------------------------------

if (!function_exists('repeater')) {
	/**
	 * Repeater function
	 *
	 * @param string $data String to repeat
	 * @param int $num Number of repeats
	 *
	 * @return    string
	 * @deprecated    3.0.0    This is just an alias for PHP's native str_repeat()
	 *
	 * @todo          Remove in version 3.1+.
	 */
	function repeater($data, $num = 1)
	{
		return ($num > 0) ? str_repeat($data, $num) : '';
	}
}

// ------------------------------------------------------------------------

if (!function_exists('remove_invisible_characters_string')) {
	/**
	 * Remove Invisible Characters
	 *
	 * This prevents sandwiching null characters
	 * between ascii characters, like Java\0script.
	 *
	 * @param string
	 * @param bool
	 *
	 * @return    string
	 */
	function remove_invisible_characters_string($str, $url_encoded = true)
	{
		$nonDisplay = array();
		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if ($url_encoded) {
			$nonDisplay[] = '/%0[0-8bcef]/i';    // url encoded 00-08, 11, 12, 14, 15
			$nonDisplay[] = '/%1[0-9a-f]/i';    // url encoded 16-31
			$nonDisplay[] = '/%7f/i';    // url encoded 127
		}
		$nonDisplay[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';    // 00-08, 11, 12, 14-31, 127
		do {
			$str = preg_replace($nonDisplay, '', $str, -1, $count);
		} while ($count);

		return $str;
	}
}

// ------------------------------------------------------------------------

if (!function_exists('starts_with')) {
	/**
	 * Checks whether a string has a precific beginning.
	 *
	 * @param string $str string to check
	 * @param string $start beginning to check for
	 * @param boolean $ignore_case whether to ignore the case
	 *
	 * @return  boolean  whether a string starts with a specified beginning
	 */
	function starts_with($str, $start, $ignore_case = false)
	{
		return (bool)preg_match('/^' . preg_quote($start, '/') . '/m' . ($ignore_case ? 'i' : ''), $str);
	}
}

// ------------------------------------------------------------------------

if (!function_exists('ends_with')) {
	/**
	 * Checks whether a string has a precific ending.
	 *
	 * @param string $str string to check
	 * @param string $end ending to check for
	 * @param boolean $ignore_case whether to ignore the case
	 *
	 * @return  boolean  whether a string ends with a specified ending
	 */
	function ends_with($str, $end, $ignore_case = false)
	{
		return (bool)preg_match('/' . preg_quote($end, '/') . '$/m' . ($ignore_case ? 'i' : ''), $str);
	}
}
