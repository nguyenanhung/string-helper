<?php
/** @noinspection UnserializeExploitsInspection */

/**
 * Project string-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/22/2021
 * Time: 14:23
 */

namespace nguyenanhung\Libraries\String;

use InvalidArgumentException;
use BadMethodCallException;

if (!class_exists('nguyenanhung\Libraries\String\Str')) {
	/**
	 * Class Str
	 *
	 * @package   nguyenanhung\Libraries\String
	 * @author    713uk13m <dev@nguyenanhung.com>
	 * @copyright 713uk13m <dev@nguyenanhung.com>
	 */
	class Str
	{
		/**
		 * The cache of snake-cased words.
		 *
		 * @var array
		 */
		public static $snakeCache = array();

		/**
		 * Returns true if $haystack ends with $needle (case-sensitive)
		 *
		 * For example:
		 *
		 *     Str::endsWith('foobar', 'bar');  // returns true
		 *     Str::endsWith('foobar', 'baz');  // returns false
		 *     Str::endsWith('foobar', 'BAR');  // returns false
		 *     Str::endsWith('foobar', '');     // returns false
		 *     Str::endsWith('', 'foobar');     // returns false
		 *
		 * @param string $haystack the string to search
		 * @param string $needle the substring to search for
		 *
		 * @return  bool  true if $haystack ends with $needle
		 *
		 * @throws  BadMethodCallException    if $haystack or $needle is omitted
		 * @throws  InvalidArgumentException  if $haystack is not a string
		 * @throws  InvalidArgumentException  if $needle is not a string
		 *
		 * @since  0.1.0
		 *
		 * @see    \nguyenanhung\Libraries\String\Str::endsWith()  case-insensitive version
		 * @see    http://stackoverflow.com/a/834355  MrHus' answer to "startsWith()
		 *    and endsWith() functions in PHP" on StackOverflow
		 */
		public static function endsWith(string $haystack, string $needle): bool
		{
			// $endsWith = false;
			// if $haystack and $needle are passed
			if ($haystack !== null && $needle !== null) {
				// if $haystack is a string
				if (is_string($haystack)) {
					$haystackLen = mb_strlen($haystack);
					// if $needle is a string
					if (is_string($needle)) {
						$needleLen = mb_strlen($needle);
						// if $haystack is not an empty string
						// if $needle is not an empty string
						if (($haystackLen > 0) && $needleLen > 0) {
							$endsWith = mb_substr($haystack, -mb_strlen($needle)) === $needle;
						} else {
							$endsWith = false;
						}
					} else {
						throw new InvalidArgumentException(__METHOD__ . " expects the second parameter, the needle, to be a string");
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . " expects the first parameter, the haystack, to be a string");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . " expects two string parameters");
			}

			return $endsWith;
		}

		/**
		 * Returns true if $haystack ends with $needle (case-insensitive)
		 *
		 *     Str::endsWith('foobar', 'bar');  // returns true
		 *     Str::endsWith('foobar', 'baz');  // returns false
		 *     Str::endsWith('foobar', 'BAR');  // returns true
		 *
		 * @param string $haystack str  the string to search
		 * @param string $needle str  the substring to search for
		 *
		 * @return  bool
		 *
		 * @throws  BadMethodCallException    if $haystack or $needle is omitted
		 * @throws  InvalidArgumentException  if $haystack is not a string
		 * @throws  InvalidArgumentException  if $needle is not a string
		 *
		 * @since  0.1.0
		 *
		 * @see    \nguyenanhung\Libraries\String\Str::iEndsWith()  case-sensitive version
		 */
		public static function iEndsWith(string $haystack, string $needle): bool
		{
			//  $endsWith = null;

			// if $haystack and $needle are given
			if ($haystack !== null && $needle !== null) {
				// if $haystack is a string
				if (is_string($haystack)) {
					// if $needle is a string
					if (is_string($needle)) {
						$endsWith = self::endsWith(mb_strtolower($haystack), mb_strtolower($needle));
					} else {
						throw new InvalidArgumentException(__METHOD__ . "() expects parameter two, needle, to be a string");
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . "() expects parameter one, haystack, to be a string");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . "() expects two string parameters, haystack and needle");
			}

			return $endsWith;
		}

		/**
		 * Function is_bool
		 *
		 * @param $string
		 *
		 * @return bool
		 * @author: 713uk13m <dev@nguyenanhung.com>
		 * @time  : 2018-12-27 22:15
		 *
		 */
		public static function is_bool($string): bool
		{
			return self::isBool($string);
		}

		/**
		 * Returns true if $string is a bool string
		 *
		 * I'll return true if $string is a bool string like 'true', 'false', 'yes', 'no',
		 * 'on' or 'off'. Keep in mind, I only handle strings. I will return false if you
		 * test an actual bool value (because it's not a string).
		 *
		 *     is_bool(true);        // returns true
		 *     Str::is_bool(true);   // returns false
		 *
		 *     is_bool('true');      // returns false
		 *     Str::isBool('true');  // returns true
		 *
		 *     is_bool('yes');       // returns false
		 *     Str::isBool('yes');   // returns true
		 *
		 * @param string $string the string to test
		 *
		 * @return  bool
		 * @since  0.1.0
		 *
		 */
		public static function isBool(string $string): bool
		{
			return is_string($string) && in_array(mb_strtolower($string), array('true', 'false', 'yes', 'no', 'on', 'off'));
		}

		/**
		 * Returns true if $haystack starts with $needle (case-insensitive)
		 *
		 * For example:
		 *
		 *     Str::iStartsWith('foobar', 'bar');  // returns false
		 *     Str::iStartsWith('foobar', 'foo');  // returns true
		 *     Str::iStartsWith('foobar', 'FOO');  // returns true
		 *     Str::iStartsWith('', 'foobar');     // returns false
		 *     Str::iStartsWith('foobar', '');     // returns false
		 *
		 * @param string $haystack the case-insensitive string to search
		 * @param string $needle the case-insensitive substring to search for
		 *
		 * @return  bool  true if $haystack ends with $needle
		 *
		 * @throws  BadMethodCallException    if $haystack or $needle is omitted
		 * @throws  InvalidArgumentException  if $haystack is not a string
		 * @throws  InvalidArgumentException  if $needle is not a string
		 *
		 * @since   0.1.0
		 *
		 * @see     \nguyenanhung\Libraries\String\Str::startsWith()  case-sensitive version
		 */
		public static function iStartsWith(string $haystack, string $needle): bool
		{
			// $startsWith = null;

			// if $haystack and $needle are given
			if ($haystack !== null && $needle !== null) {
				// if $haystack is a string
				if (is_string($haystack)) {
					// if $needle is a string
					if (is_string($needle)) {
						$startsWith = self::startsWith(mb_strtolower($haystack), mb_strtolower($needle));
					} else {
						throw new InvalidArgumentException(__METHOD__ . "() expects parameter two, needle, to be a string");
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . "() expects parameter one, haystack, to be a string");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . "() expects two string parameters, haystack and needle");
			}

			return $startsWith;
		}

		/**
		 * Returns a random string of $length that follows the charset $rules
		 *
		 * Oftetimes, standards (like PCI) require passwords with one upper-case letter, one
		 * lower-case letter, one number, and one symbol. I can do that.
		 *
		 * For example:
		 *
		 *     $rules = ['upper' => 12];
		 *     $a = Str::password(12, $rules);
		 *
		 *     $rules = ['lower' => 6, 'upper' => 6];
		 *     $b = Str::password(12, $rules);
		 *
		 *     $rules = ['lower' => 4, 'upper' => 4, 'number' => 4];
		 *     $c = Str::password(12, $rules);
		 *
		 *     echo $a;  // example 'KNVHYUIDGVDS'
		 *     echo $b;  // example 'jNhGFkLekOfV'
		 *     echo $c;  // example 'la9Uh7BH4Bc3'
		 *
		 * @param int $length the length of the password (optional; if omitted,
		 *                       defaults to 8)
		 * @param int[] $rules an array of character counts indexed by charset name
		 *                       (possible charset names are 'lower', 'upper', 'number', 'alpha', and 'symbol')
		 *                       (optional; if omitted, defaults to ['lower' => 1, 'upper' => 1, 'number' => 1,
		 *                       'symbol' => 1])
		 *
		 * @return  string  the password
		 *
		 * @throws  BadMethodCallException    if $rules or $length is omitted
		 * @throws  InvalidArgumentException  if $rules is not an array
		 * @throws  InvalidArgumentException  if $length is not an integer
		 * @throws  InvalidArgumentException  if a key in $rules is not a valid charset name
		 * @throws  InvalidArgumentException  if a value in $rules is not an integer
		 * @throws  InvalidArgumentException  if the number of required characters (as defined
		 *    in the $rules array) exceeds the $length
		 * @since  0.1.0
		 *
		 */
		public static function password(int $length = 8, array $rules = array('lower' => 1, 'upper' => 1, 'number' => 1, 'symbol' => 1)): string
		{
			$password = '';

			// if $rules and $length are given
			if ($rules !== null && $length !== null) {
				// if $rules is an array
				if (is_array($rules)) {
					// if $length is an integer
					if (is_numeric($length) && is_int(+$length)) {
						// if the number of required characters is LTE the desired length
						if (array_sum($rules) <= $length) {
							// loop through the password's rules
							foreach ($rules as $charset => $number) {
								$password .= self::rand($number, $charset);
							}
							// if any characters are missing, add them
							if ($length - mb_strlen($password) > 0) {
								$password .= self::rand($length - mb_strlen($password));
							}
							// shuffle the password
							$password = str_shuffle($password);
						} else {
							throw new InvalidArgumentException(__METHOD__ . " expects the number of required characters to be less than or " . "equal to the length");
						}
					} else {
						throw new InvalidArgumentException(__METHOD__ . " expects the seond parameter, length, to be an integer");
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . " expects the first parameter, rules, to be an array");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . " expects two parameters, an array of charset rules and a length");
			}

			return $password;
		}

		/**
		 * Returns a random string
		 *
		 * For example:
		 *
		 *     echo Str::rand(8, 'alpha');              // example 'hbdrckso'
		 *     echo Str::rand(8, ['lower', 'number']);  // example 'k987hb54'
		 *     echo Str::rand(8, ['upper', 'symbol']);  // example 'HG!V*X]@'
		 *
		 * @param int $length the length of the string to return
		 * @param mixed $charsets a string charset name or an array of charset names
		 *                         (possible values are are 'lower', 'upper', 'alpha' (a combination of 'upper'
		 *                         and 'lower'), 'number', and 'symbol') (optional; if omitted, defaults to
		 *                         ['alpha', 'number', 'symbol'])
		 *
		 * @return  string  a random string
		 *
		 * @throws  BadMethodCallException    if $length or $charset is null
		 * @throws  InvalidArgumentException  if $length is not an integer
		 * @throws  InvalidArgumentException  if $charsets is not a string or array
		 * @throws  InvalidArgumentException  if a given $charset is not a valid charset
		 * @since  0.1.0
		 *
		 */
		public static function rand(int $length, $charsets = array('alpha', 'number', 'symbol')): string
		{
			$rand = '';

			// if $length and $charsets are given
			if ($length !== null && $charsets !== null) {
				// if $length is an integer
				if (is_numeric($length) && is_int(+$length)) {
					// if $charsets is a string or array
					if (is_string($charsets) || is_array($charsets)) {
						// if $charsets is a string, array-ify it
						$charsets = (array)$charsets;

						// define the possible charsets
						$lower = array(
							'a',
							'b',
							'c',
							'd',
							'e',
							'f',
							'g',
							'h',
							'i',
							'j',
							'k',
							'l',
							'm',
							'n',
							'o',
							'p',
							'q',
							'r',
							's',
							't',
							'u',
							'v',
							'w',
							'x',
							'y',
							'z'
						);
						$upper = array(
							'A',
							'B',
							'C',
							'D',
							'E',
							'F',
							'G',
							'H',
							'I',
							'J',
							'K',
							'L',
							'M',
							'N',
							'O',
							'P',
							'Q',
							'R',
							'S',
							'T',
							'U',
							'V',
							'W',
							'X',
							'Y',
							'Z'
						);
						$number = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
						$symbol = array('!', '@', '#', '*', '(', ')', '-', '_', '+', '=', '[', ']');

						// create an array of possible chars
						$chars = array();
						foreach ($charsets as $charset) {
							if (isset($charset)) {
								$chars = array_merge($chars, $charset);
							} elseif ($charset === 'alpha') {
								$chars = array_merge($chars, $lower, $upper);
							} else {
								throw new InvalidArgumentException(__METHOD__ . " expects parameter two to be a string charset name or an array " . "of charset names such as 'lower', 'upper', 'alpha', 'number', or 'symbol'");
							}
						}

						// shuffle the chars
						shuffle($chars);

						// pick $length random chars
						for ($i = 0; $i < $length; ++$i) {
							$rand .= $chars[array_rand($chars)];
						}
					} else {
						throw new InvalidArgumentException(__METHOD__ . " expects the second parameter, charsets, to be a string charset " . "name or an array of charset names");
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . " expects the first parameter, length, to be an integer");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . " expects at least one argument, length");
			}

			return $rand;
		}

		/**
		 * Function random
		 *
		 * @param int $length
		 * @param string $type
		 *
		 * @return int|string|null
		 * @author   : 713uk13m <dev@nguyenanhung.com>
		 * @copyright: 713uk13m <dev@nguyenanhung.com>
		 * @time     : 14/02/2023 54:56
		 */
		public static function random(int $length = 16, string $type = 'alnum')
		{
			return self::randomString($type, $length);
		}

		/**
		 * Create a "Random" String
		 *
		 * @param string $type type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
		 * @param int $length number of characters
		 *
		 * @return int|string|null
		 * @author: 713uk13m <dev@nguyenanhung.com>
		 * @time  : 9/29/18 11:25
		 *
		 */
		public static function randomString(string $type = 'alnum', int $length = 16)
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
						$str .= mb_substr($pool, mt_rand(0, mb_strlen($pool) - 1), 1);
					}

					return $str;
					break;

				case 'md5':
				case 'unique':
					return md5(uniqid(mt_rand(), true));
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
						static::randomString('hexdec', 8),
						static::randomString('hexdec', 4),
						static::randomString('hexdec', 3),
						$pool[array_rand($pool)],
						static::randomString('hexdec', 3),
						static::randomString('hexdec', 12)
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

		/**
		 * Splits a string on the first alpha character
		 *
		 * I'll return an array with two parts. The first element is the string part before
		 * the first alpha character, and the second part is everything after and including
		 * the first alpha character.
		 *
		 * For example:
		 *
		 *     Str::splitOnFirstAlpha("123");        // returns ["123"]
		 *     Str::splitOnFirstAlpha("abc");        // returns ["", "abc"]
		 *     Str::splitOnFirstAlpha("123 abc");    // returns ["123", "abc"]
		 *     Str::splitOnFirstAlpha("1 2 3 abc");  // returns ["1 2 3 4", "abc"]
		 *
		 * @param string $string the string to split
		 *
		 * @return  string[]  an array
		 *
		 * @throws  BadMethodCallException    if $string is null
		 * @throws  InvalidArgumentException  if $string is not a string
		 *
		 * @since   0.1.0
		 *
		 * @see     http://stackoverflow.com/a/18990341  FrankieTheKneeMan's answer to "Split
		 *    string on first occurrence of a letter" on StackOverflow (version using Regex
		 *    lookahead)
		 */
		public static function splitOnFirstAlpha(string $string): array
		{
			// $pieces = array();

			// if $string is not null
			if ($string !== null) {
				// if $string is actually a string
				if (is_string($string)) {
					// if the trimmed string isn't empty
					$string = trim($string);
					if ($string !== '') {
						$pieces = array_map('trim', preg_split('/(?=[a-zA-Z])/i', $string, 2));
					} else {
						$pieces = array();
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . "() expects parameter one to be a string");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . "() expects one parameter, a string");
			}

			return $pieces;
		}

		/**
		 * Returns true if $haystack starts with $needle (case-sensitive)
		 *
		 * For example:
		 *
		 *     Str::startsWith('foobar', 'bar');  // returns false
		 *     Str::startsWith('foobar', 'foo');  // returns true
		 *     Str::startsWith('foobar', 'FOO');  // returns false
		 *     Str::startsWith('foobar', '');     // returns false
		 *     Str::startsWith('', 'foobar');     // returns false
		 *
		 * @param string $haystack the string to search
		 * @param string $needle the substring to search for
		 *
		 * @return  bool  true if $haystack starts with $needle
		 *
		 * @throws  BadMethodCallException    if $haystack or $needle is omitted
		 * @throws  InvalidArgumentException  if $haystack is not a string
		 * @throws  InvalidArgumentException  if $needle is not a string
		 *
		 * @since  0.1.0
		 *
		 * @see    \nguyenanhung\Libraries\String\Str::startsWith()  case-insensitive version
		 * @see    http://stackoverflow.com/a/834355  MrHus' answer to "startsWith() and
		 *    endsWith() functions in PHP" on StackOverflow
		 */
		public static function startsWith(string $haystack, string $needle): bool
		{
			// $startsWith = false;

			// if $haystack and $needle are given
			if ($haystack !== null && $needle !== null) {
				// if $haystack is a string
				if (is_string($haystack)) {
					$haystackLen = mb_strlen($haystack);
					// if $needle is a string
					if (is_string($needle)) {
						// if $haystack is not empty
						if ($haystackLen > 0) {
							$needleLen = mb_strlen($needle);
							// if $needle is not empty
							if ($needleLen > 0) {
								$startsWith = !strncmp($haystack, $needle, mb_strlen($needle));
							} else {
								$startsWith = false;
							}
						} else {
							$startsWith = false;
						}
					} else {
						throw new InvalidArgumentException(__METHOD__ . " expects the second parameter, the needle, to be a string");
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . " expects the first parameter, the haystack, to be a string");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . " expects two string parameters, haystack and needle");
			}

			return $startsWith;
		}

		/**
		 * Converts a php.ini-like byte notation shorthand to a number of bytes
		 *
		 * In the php.ini configuration file, byte values are sote in shorthand
		 * notation (e.g., "8M"). PHP's native ini_get() function will return the
		 * exact string stored in php.ini and not its integer equivalent. I will
		 * return the integer equivalent.
		 *
		 * For example:
		 *
		 *     Str::strtobytes('1K');  // returns 1024
		 *     Str::strtobytes('1M');  // returns 1048576
		 *     Str::strtobytes('1G');  // returns 1073741824
		 *
		 * @param string $string the string to convert
		 *
		 * @return  int|float  the number of bytes
		 *
		 * @throws  BadMethodCallException    if $string is null
		 * @throws  InvalidArgumentException  if $string is not a string
		 * @throws  InvalidArgumentException  if $string does not end in 'k', 'm', or 'g'
		 *
		 * @since   0.1.0
		 *
		 * @see     http://www.php.net/manual/en/function.ini-get.php  ini_get() man page
		 */
		public static function strToBytes(string $string)
		{
			// $val = false;

			// if $string is given
			if ($string !== null) {
				// if $string is actually a string
				if (is_string($string)) {
					// get the string's last character
					$val = trim($string);
					$last = mb_strtolower($val[mb_strlen($val) - 1]);

					switch ($last) {

						case 'm':
						case 'k':
						case 'g':
							$val *= 1024;
							break;
						// no break

						// no break

						default:
							throw new InvalidArgumentException(__METHOD__ . " expects the first parameter to end in 'k', 'm', or 'g'");
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . " expects the first parameter to be a string");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . " expects one parameter");
			}

			return $val;
		}

		/**
		 * Function upperCase - Convert the given string to upper-case.
		 *
		 * @param $value
		 *
		 * @return string
		 * @author   : 713uk13m <dev@nguyenanhung.com>
		 * @copyright: 713uk13m <dev@nguyenanhung.com>
		 * @time     : 08/18/2021 51:39
		 */
		public static function upperCase($value): string
		{
			return mb_strtoupper($value, 'UTF-8');
		}

		/**
		 * Function lowerCase - Convert the given string to lower-case.
		 *
		 * @param $value
		 *
		 * @return string
		 * @author   : 713uk13m <dev@nguyenanhung.com>
		 * @copyright: 713uk13m <dev@nguyenanhung.com>
		 * @time     : 08/18/2021 51:28
		 */
		public static function lowerCase($value): string
		{
			return mb_strtolower($value, 'UTF-8');
		}

		/**
		 * Convert a string to snake case.
		 *
		 * @param        $value
		 * @param string $delimiter
		 *
		 * @return bool|false|mixed|string|string[]|null
		 * @author: 713uk13m <dev@nguyenanhung.com>
		 * @time  : 2018-12-27 22:21
		 *
		 */
		public static function snakeCase($value, string $delimiter = '_')
		{
			$key = $value;
			if (isset(static::$snakeCache[$key][$delimiter])) {
				return static::$snakeCache[$key][$delimiter];
			}
			if (!ctype_lower($value)) {
				$value = preg_replace('/\s+/u', '', ucwords($value));
				$value = static::lowerCase(preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value));
			}

			return static::$snakeCache[$key][$delimiter] = $value;
		}

		/**
		 * Returns a string in camel case
		 *
		 * For example:
		 *
		 *     Str::strtocamelcase('Hello world');   // returns "helloWorld"
		 *     Str::strtocamelcase('H3LLO WORLD!');  // returns "helloWorld"
		 *     Str::strtocamelcase('hello_world');   // returns "helloWorld"
		 *
		 * @param string $string the string to camel-case
		 *
		 * @return  string  the camel-cased string
		 *
		 * @throws  BadMethodCallException    if $string is empty
		 * @throws  InvalidArgumentException  if $string is not a string
		 * @since  0.1.0
		 *
		 */
		public static function strToCamelCase(string $string): string
		{
			// if $string is given
			if ($string !== null) {
				// if $string is actually a string
				if (is_string($string)) {
					$stringLen = mb_strlen($string);
					// if $string is not empty
					if ($stringLen) {
						// trim the string
						$string = trim($string);

						// replace underscores ("_") and hyphens ("-") with spaces (" ")
						$string = str_replace(array('-', '_'), ' ', $string);

						// lower-case everything
						$string = mb_strtolower($string);

						// capitalize each word
						$string = ucwords($string);

						// remove spaces
						$string = str_replace(' ', '', $string);

						// lower-case the first word
						$string = lcfirst($string);

						// remove any non-alphanumeric characters
						$string = preg_replace("#[^a-zA-Z0-9]+#", '', $string);
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . " expects the first parameter, the string, to be a string");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . " expects one parameter, a string to camel-case");
			}

			return $string;
		}

		/**
		 * Function reverseCase
		 *
		 * @param $str
		 *
		 * @return array|int
		 * @author: 713uk13m <dev@nguyenanhung.com>
		 * @time  : 2018-12-27 22:19
		 *
		 */
		public static function reverseCase($str)
		{
			if (!is_array($str)) {
				return mb_strtolower($str) ^ mb_strtoupper($str) ^ $str;
			}
			foreach ($str as $key => $value) {
				$str[$key] = mb_strtolower($value) ^ mb_strtoupper($value) ^ $value;
			}

			return $str;
		}

		/**
		 * Function title_case
		 *
		 * @param $str
		 *
		 * @return array|string
		 * @author: 713uk13m <dev@nguyenanhung.com>
		 * @time  : 2018-12-27 22:19
		 *
		 */
		public static function titleCase($str)
		{
			if (!is_array($str)) {
				return ucwords(mb_strtolower($str));
			}
			foreach ($str as $key => $value) {
				$str[$key] = ucwords(mb_strtolower($value));
			}

			return $str;
		}

		/**
		 * Function camelizeCase
		 *
		 * @param        $str
		 * @param string $encoding
		 *
		 * @return string|string[]|null
		 * @author: 713uk13m <dev@nguyenanhung.com>
		 * @time  : 2018-12-27 22:19
		 *
		 */
		public static function camelizeCase($str, string $encoding = 'UTF-8')
		{
			$str = str_replace(array('_', '-'), ' ', mb_strtolower(trim($str)));
			$str = mb_convert_case($str, MB_CASE_TITLE, $encoding);

			return preg_replace('!\s+!', '', $str);
		}

		/**
		 * Truncates $string to a preferred length
		 *
		 *     Str::truncate('Lorem ipsum inum', 8);             // returns 'Lorem ipsum...'
		 *     Str::truncate('Lorem ipsum inum', 8, '');         // returns 'Lorem ip...'
		 *     Str::truncate('Lorem ipsum inum', 8, ' ', ' >');  // returns 'Lorem ipsum >'
		 *
		 * @param mixed $string the string to truncate
		 * @param mixed $limit the string's max length
		 * @param string $break the break character (to truncate at exact length set to
		 *                          empty string or null) (if the break character does not exist in the string,
		 *                          the string will be truncated at limit) (optional; if omitted, defaults to ' ')
		 * @param string $pad the padding to add to end of string (optional; if
		 *                          omitted, defaults to '...')
		 *
		 * @return  string  the truncated string
		 *
		 * @throws  BadMethodCallException    if $string or $limit is omitted
		 * @throws  InvalidArgumentException  if $string is not a string
		 * @throws  InvalidArgumentException  if $limit is not an integer (or integer string)
		 * @throws  InvalidArgumentException  if $break is not a string or null
		 * @throws  InvalidArgumentException  if $pad is not a string or null
		 *
		 * @since   0.1.0
		 *
		 * @see     http://blog.justin.kelly.org.au/php-truncate/  The original function
		 *    from "Best PHP Truncate Function" posted 6/27/12 on "Justin Kelly - various
		 *    ramblings" (edited to find closest break *before* limit and truncate string
		 *    exactly if break does not exist)
		 */
		public static function truncate($string, $limit, string $break = ' ', string $pad = '...'): string
		{
			// $truncated = null;

			// if $string and $limit are given
			if ($string !== null && $limit !== null) {
				// if $string is actually a string
				if (is_string($string)) {
					// if $limit is a number
					if (is_numeric($limit) && is_int(+$limit)) {
						// if $break is a string or it's null
						if (is_string($break) || is_null($break)) {
							// if $pad is a string or it's null
							if (is_string($pad) || is_null($pad)) {
								// if $string is longer than $limit
								if (mb_strlen($string) > $limit) {
									// truncate the string at the limit
									$truncated = mb_substr($string, 0, $limit);
									// if a break character is defined and it exists in the truncated string
									if ($break !== null && $break !== '' && mb_strpos($truncated, $break)) {
										$truncated = mb_substr($truncated, 0, mb_strrpos($truncated, $break));
									}
									// if a pad exists, use it
									if ($pad !== null && $pad !== '') {
										$truncated .= $pad;
									}
								} else {
									$truncated = $string;
								}
							} else {
								throw new InvalidArgumentException(__METHOD__ . "() expects the fourth parameter, pad, to be a string or null");
							}
						} else {
							throw new InvalidArgumentException(__METHOD__ . "() expects the third parameter, break, to be a string or null");
						}
					} else {
						throw new InvalidArgumentException(__METHOD__ . "() expects the second parameter, limit, to be an integer");
					}
				} else {
					throw new InvalidArgumentException(__METHOD__ . "() expects the first parameter, the string, to be a string");
				}
			} else {
				throw new BadMethodCallException(__METHOD__ . "() expects at least two parameters, a string and an integer length limit");
			}

			return $truncated;
		}

		/**
		 * Function stripSlashes
		 *
		 * @param $str
		 *
		 * @return array|string
		 * @author   : 713uk13m <dev@nguyenanhung.com>
		 * @copyright: 713uk13m <dev@nguyenanhung.com>
		 * @time     : 08/18/2021 50:48
		 */
		public static function stripSlashes($str)
		{
			if (!is_array($str)) {
				return stripslashes($str);
			}
			foreach ($str as $key => $values) {
				$str[$key] = stripslashes($values);
			}

			return $str;
		}

		/**
		 * Function stripQuotes
		 *
		 * @param $str
		 *
		 * @return array|string|string[]
		 * @author   : 713uk13m <dev@nguyenanhung.com>
		 * @copyright: 713uk13m <dev@nguyenanhung.com>
		 * @time     : 08/18/2021 50:43
		 */
		public static function stripQuotes($str)
		{
			if (!is_array($str)) {
				return str_replace(['"', "'"], '', $str);
			}
			foreach ($str as $key => $value) {
				$str[$key] = str_replace(['"', "'"], '', $value);
			}

			return $str;
		}

		/**
		 * Function convertStrToEn
		 *
		 * @param string $str
		 * @param string $separator
		 *
		 * @return array|mixed|string|string[]
		 * @author   : 713uk13m <dev@nguyenanhung.com>
		 * @copyright: 713uk13m <dev@nguyenanhung.com>
		 * @time     : 08/18/2021 47:43
		 */
		public static function convertStrToEn(string $str = '', string $separator = '-')
		{
			$str = trim($str);
			if (function_exists('mb_strtolower')) {
				$str = mb_strtolower($str);
			} else {
				$str = mb_strtolower($str);
			}
			$data = DataRepository::getData('string');
			if (!empty($str)) {
				$str = preg_replace("/[^a-zA-Z0-9]/", $separator, $str);
				$str = preg_replace("/-+/", $separator, $str);
				$str = str_replace(array($data['special_array'], $data['vn_array'], $data['ascii_array'], $data['utf8_array'], ' '), array($separator, $data['en_array'], $data['normal_array'], $data['normal_array'], $separator), $str);
				while (mb_strpos($str, '--') > 0) {
					$str = str_replace('--', $separator, $str);
				}
				while (mb_strpos($str, '--') === 0) {
					$str = str_replace('--', $separator, $str);
				}
			}

			return $str;
		}

		/**
		 * Check if a string is json encoded
		 *
		 * @param string $string string to check
		 *
		 * @return bool
		 */
		public static function isJson(string $string): bool
		{
			json_decode($string, true);

			return json_last_error() === JSON_ERROR_NONE;
		}

		/**
		 * Check if a string is a valid XML
		 *
		 * @param string $string string to check
		 *
		 * @return bool
		 */
		public static function isXML(string $string): bool
		{
			$internal_errors = libxml_use_internal_errors();
			libxml_use_internal_errors(true);
			$result = simplexml_load_string($string) !== false;
			libxml_use_internal_errors($internal_errors);

			return $result;
		}

		/**
		 * Check if a string is serialized
		 *
		 * @param string $string string to check
		 *
		 * @return bool
		 */
		public static function isSerialized(string $string): bool
		{
			$array = @unserialize($string);

			return !($array === false and $string !== 'b:0;');
		}

		/**
		 * Check if a string is html
		 *
		 * @param string $string string to check
		 *
		 * @return bool
		 */
		public function isHTML(string $string): bool
		{
			return mb_strlen(strip_tags($string)) < mb_strlen($string);
		}

		/**
		 * Inserts one or more strings into another string on a defined position.
		 *
		 * ### str_insert
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_insert( array $keyValue, string $string ): string
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $keyValue = [
		 *      ':color' => 'brown',
		 *      ':animal' => 'dog'
		 * ]
		 * $string = 'The quick :color fox jumps over the lazy :animal.';
		 *
		 * str_insert( $keyValue, $string );
		 *
		 * // The quick brown fox jumps over the lazy dog.
		 * ```
		 *
		 * @param array $keyValue
		 * An associative array with key => value pairs.
		 * @param string $string
		 * The text with the strings to be replaced.
		 *
		 * @return string
		 * The replaced string.
		 */
		public static function insert($keyValue, $string)
		{
			if (is_assoc($keyValue)) {
				foreach ($keyValue as $search => $replace) {
					$string = str_replace($search, $replace, $string);
				}
			}

			return $string;
		}

		/**
		 * Return the content in a string between a left and right element.
		 *
		 * ### str_between
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_between( string $left, string $right, string $string ): array
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = '<tag>foo</tag>foobar<tag>bar</tag>'
		 *
		 * str_between( '<tag>', '</tag>' $string );
		 *
		 * // (
		 * //     [0] => foo
		 * //     [1] => bar
		 * // )
		 * ```
		 *
		 *
		 * @param string $left
		 * The left element of the string to search.
		 * @param string $right
		 * The right element of the string to search.
		 * @param string $string
		 * The string to search in.
		 *
		 * @return array
		 * A result array with all matches of the search.
		 */
		public static function between($left, $right, $string)
		{
			preg_match_all('/' . preg_quote($left, '/') . '(.*?)' . preg_quote($right, '/') . '/s', $string, $matches);

			return array_map('trim', $matches[1]);
		}

		/**
		 * Return the part of a string after a given value.
		 *
		 * ### str_after
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_after( string $search, string $string ): string
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = 'The quick brown fox jumps over the lazy dog';
		 *
		 * str_after( 'fox' $string );
		 *
		 * // jumps over the lazy dog
		 * ```
		 *
		 * @param string $search
		 * The string to search for.
		 * @param string $string
		 * The string to search in.
		 *
		 * @return string
		 * The found string after the search string. Whitespaces at beginning will be removed.
		 */
		public static function after($search, $string)
		{
			return $search === '' ? $string : ltrim(array_reverse(explode($search, $string, 2))[0]);
		}

		/**
		 * Get the part of a string before a given value.
		 *
		 * ### str_before
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_before( string $search, string $string ): string
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = 'The quick brown fox jumps over the lazy dog';
		 *
		 * str_before( 'fox' $string );
		 *
		 * // The quick brown
		 * ```
		 *
		 * @param string $search
		 * The string to search for.
		 * @param string $string
		 * The string to search in.
		 *
		 * @return string
		 * The found string before the search string. Whitespaces at end will be removed.
		 */
		public static function before($search, $string)
		{
			return $search === '' ? $string : rtrim(explode($search, $string)[0]);
		}

		/**
		 * Limit the number of words in a string. Put value of $end to the string end.
		 *
		 * ### str_limit_words
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_limit_words( string $string, int $limit = 10, string $end = '...' ): string
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = 'The quick brown fox jumps over the lazy dog';
		 *
		 * str_limit_words( $string, 3 );
		 *
		 * // The quick brown...
		 * ```
		 *
		 * @param string $string
		 * The string to limit the words.
		 * @param int $limit
		 * The number of words to limit. Defaults to 10.
		 * @param string $end
		 * The string to end the cut string. Defaults to '...'
		 *
		 * @return string
		 * The limited string with $end at the end.
		 */
		public static function limitWords($string, $limit = 10, $end = '...')
		{
			$arrayWords = explode(' ', $string);

			if (sizeof($arrayWords) <= $limit) {
				return $string;
			}

			return implode(' ', array_slice($arrayWords, 0, $limit)) . $end;
		}

		/**
		 * Limit the number of characters in a string. Put value of $end to the string end.
		 *
		 * ### str_limit
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_limit( string $string, int $limit = 100, string $end = '...' ): string
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = 'The quick brown fox jumps over the lazy dog';
		 *
		 * str_limit( $string, 15 );
		 *
		 * // The quick brown...
		 * ```
		 *
		 * @param string $string
		 * The string to limit the characters.
		 * @param int $limit
		 * The number of characters to limit. Defaults to 100.
		 * @param string $end
		 * The string to end the cut string. Defaults to '...'
		 *
		 * @return string
		 * The limited string with $end at the end.
		 */
		public static function limit($string, $limit = 100, $end = '...')
		{
			if (mb_strwidth($string, 'UTF-8') <= $limit) {
				return $string;
			}

			return rtrim(mb_strimwidth($string, 0, $limit, '', 'UTF-8')) . $end;
		}

		/**
		 * Tests if a string contains a given element
		 *
		 * ### str_contains
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_contains( string|array $needle, string $haystack ): boolean
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = 'The quick brown fox jumps over the lazy dog';
		 * $array = [
		 *      'cat',
		 *      'fox'
		 * ];
		 *
		 * str_contains( $array, $string );
		 *
		 * // bool(true)
		 * ```
		 *
		 * @param string|array $needle
		 * A string or an array of strings.
		 * @param string $haystack
		 * The string to search in.
		 *
		 * @return bool
		 * True if $needle is found, false otherwise.
		 */
		public static function contains($needle, $haystack)
		{
			foreach ((array)$needle as $ndl) {
				if (mb_strpos($haystack, $ndl) !== false) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Tests if a string contains a given element. Ignore case sensitivity.
		 *
		 * ### str_icontains
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_icontains( string|array $needle, string $haystack ): boolean
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = 'The quick brown fox jumps over the lazy dog';
		 * $array = [
		 *      'Cat',
		 *      'Fox'
		 * ];
		 *
		 * str_icontains( $array, $string );
		 *
		 * // bool(true)
		 * ```
		 *
		 * @param string|array $needle
		 * A string or an array of strings.
		 * @param string $haystack
		 * The string to search in.
		 *
		 * @return bool
		 * True if $needle is found, false otherwise.
		 */
		public static function containsIgnoreCase($needle, $haystack)
		{
			foreach ((array)$needle as $ndl) {
				if (stripos($haystack, $ndl) !== false) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Determine if a given string starts with a given substring. Ignore case sensitivity.
		 *
		 * ### str_istarts_with
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_istarts_with( string|array $needle, string $haystack ): boolean
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = 'The quick brown fox jumps over the lazy dog';
		 * $array = [
		 *      'cat',
		 *      'the'
		 * ];
		 *
		 * str_istarts_with( $array, $string );
		 *
		 * // bool(true)
		 * ```
		 *
		 * @param string|array $needle
		 * The string or array of strings to search for.
		 * @param string $haystack
		 * The string to search in.
		 *
		 * @return bool
		 * True if $needle was found, false otherwise.
		 */
		public static function startsWithIgnoreCase($needle, $haystack)
		{
			$hs = mb_strtolower($haystack);

			foreach ((array)$needle as $ndl) {
				$n = mb_strtolower($ndl);
				if ($n !== '' && mb_substr($hs, 0, mb_strlen($n)) === (string)$n) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Determine if a given string ends with a given substring.
		 *
		 * ### str_iends_with
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_iends_with( string|array $needle, string $haystack ): boolean
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $string = 'The quick brown fox jumps over the lazy dog';
		 * $array = [
		 *      'Cat',
		 *      'Dog'
		 * ];
		 *
		 * str_iends_with( $array, $string );
		 *
		 * // bool(true)
		 * ```
		 *
		 * @param string|array $needle
		 * The string or array of strings to search for.
		 * @param string $haystack
		 * The string to search in.
		 *
		 * @return bool
		 * True if $needle was found, false otherwise.
		 */
		public static function endsWithIgnoreCase($needle, $haystack)
		{
			$hs = mb_strtolower($haystack);

			foreach ((array)$needle as $ndl) {
				$n = mb_strtolower($ndl);
				$length = mb_strlen($ndl);
				if ($length === 0 || (mb_substr($hs, -$length) === (string)$n)) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Return the part of a string after the last occurrence of a given search value.
		 *
		 * ### str_after_last
		 * Related global function (description see above).
		 *
		 * > #### [( jump back )](#available-php-functions)
		 *
		 * ```php
		 * str_after_last( string $search, string $string ): string
		 * ```
		 *
		 * #### Example
		 * ```php
		 * $path = "/var/www/html/public/img/image.jpg";
		 *
		 * str_after_last( '/' $path );
		 *
		 * // image.jpg
		 * ```
		 *
		 * @param string $search
		 * The string to search for.
		 * @param string $string
		 * The string to search in.
		 *
		 * @return string
		 * The found string after the last occurrence of the search string. Whitespaces at beginning will be removed.
		 */
		public static function afterLast($search, $string)
		{
			return $search === '' ? $string : ltrim(array_reverse(explode($search, $string))[0]);
		}
	}
}
