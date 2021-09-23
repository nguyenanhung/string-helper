<?php
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
        public static $snakeCache = [];

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
         * @since  0.1.0
         *
         * @param string $haystack the string to search
         * @param string $needle   the substring to search for
         *
         * @return  bool  true if $haystack ends with $needle
         *
         * @throws  BadMethodCallException    if $haystack or $needle is omitted
         * @throws  InvalidArgumentException  if $haystack is not a string
         * @throws  InvalidArgumentException  if $needle is not a string
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
                            $endsWith = substr($haystack, -strlen($needle)) === $needle;
                        } else {
                            $endsWith = false;
                        }
                    } else {
                        throw new InvalidArgumentException(
                            __METHOD__ . " expects the second parameter, the needle, to be a string"
                        );
                    }
                } else {
                    throw new InvalidArgumentException(
                        __METHOD__ . " expects the first parameter, the haystack, to be a string"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . " expects two string parameters"
                );
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
         * @since  0.1.0
         *
         * @param string $haystack str  the string to search
         * @param string $needle   str  the substring to search for
         *
         * @return  bool
         *
         * @throws  BadMethodCallException    if $haystack or $needle is omitted
         * @throws  InvalidArgumentException  if $haystack is not a string
         * @throws  InvalidArgumentException  if $needle is not a string
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
                        $endsWith = self::endsWith(strtolower($haystack), strtolower($needle));
                    } else {
                        throw new InvalidArgumentException(
                            __METHOD__ . "() expects parameter two, needle, to be a string"
                        );
                    }
                } else {
                    throw new InvalidArgumentException(
                        __METHOD__ . "() expects parameter one, haystack, to be a string"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . "() expects two string parameters, haystack and needle"
                );
            }

            return $endsWith;
        }

        /**
         * Function is_bool
         *
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-27 22:15
         *
         * @param $string
         *
         * @return bool
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
         * @since  0.1.0
         *
         * @param string $string the string to test
         *
         * @return  bool
         */
        public static function isBool(string $string): bool
        {
            return is_string($string)
                   && in_array(strtolower($string), array('true', 'false', 'yes', 'no', 'on', 'off'));
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
         * @since   0.1.0
         *
         * @param string $haystack the case-insensitive string to search
         * @param string $needle   the case-insensitive substring to search for
         *
         * @return  bool  true if $haystack ends with $needle
         *
         * @throws  BadMethodCallException    if $haystack or $needle is omitted
         * @throws  InvalidArgumentException  if $haystack is not a string
         * @throws  InvalidArgumentException  if $needle is not a string
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
                        $startsWith = self::startsWith(strtolower($haystack), strtolower($needle));
                    } else {
                        throw new InvalidArgumentException(
                            __METHOD__ . "() expects parameter two, needle, to be a string"
                        );
                    }
                } else {
                    throw new InvalidArgumentException(
                        __METHOD__ . "() expects parameter one, haystack, to be a string"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . "() expects two string parameters, haystack and needle"
                );
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
         * @since  0.1.0
         *
         * @param int   $length  the length of the password (optional; if omitted,
         *                       defaults to 8)
         * @param int[] $rules   an array of character counts indexed by charset name
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
                            if ($length - strlen($password) > 0) {
                                $password .= self::rand($length - strlen($password));
                            }
                            // shuffle the password
                            $password = str_shuffle($password);
                        } else {
                            throw new InvalidArgumentException(
                                __METHOD__ . " expects the number of required characters to be less than or " .
                                "equal to the length"
                            );
                        }
                    } else {
                        throw new InvalidArgumentException(
                            __METHOD__ . " expects the seond parameter, length, to be an integer"
                        );
                    }
                } else {
                    throw new InvalidArgumentException(
                        __METHOD__ . " expects the first parameter, rules, to be an array"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . " expects two parameters, an array of charset rules and a length"
                );
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
         * @since  0.1.0
         *
         * @param int   $length    the length of the string to return
         * @param mixed $charsets  a string charset name or an array of charset names
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
                        $charsets = (array) $charsets;

                        // define the possible charsets
                        $lower  = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l',
                                        'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
                        $upper  = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L',
                                        'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
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
                                throw new InvalidArgumentException(
                                    __METHOD__ . " expects parameter two to be a string charset name or an array " .
                                    "of charset names such as 'lower', 'upper', 'alpha', 'number', or 'symbol'"
                                );
                            }
                        }

                        // shuffle the chars
                        shuffle($chars);

                        // pick $length random chars
                        for ($i = 0; $i < $length; ++$i) {
                            $rand .= $chars[array_rand($chars)];
                        }
                    } else {
                        throw new InvalidArgumentException(
                            __METHOD__ . " expects the second parameter, charsets, to be a string charset " .
                            "name or an array of charset names"
                        );
                    }
                } else {
                    throw new InvalidArgumentException(
                        __METHOD__ . " expects the first parameter, length, to be an integer"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . " expects at least one argument, length"
                );
            }

            return $rand;
        }

        /**
         * Function random
         *
         * @param int    $length
         * @param string $type
         *
         * @return bool|int|string
         * @throws \Exception
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 09/22/2021 46:12
         */
        public static function random(int $length = 16, string $type = 'alnum')
        {
            $string = '';
            switch ($type) {
                case 'basic':
                    return mt_rand();
                case 'alnum':
                    while (($len = strlen($string)) < $length) {
                        $size   = $length - $len;
                        $bytes  = random_bytes($size);
                        $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
                    }
                    break;
                case 'alpha':
                    $data = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    while ((strlen($string)) < $length) {
                        $string .= $data[random_int(0, strlen($data) - 1)];
                    }
                    break;
                case 'numeric':
                    $data = "01234567890";
                    while ((strlen($string)) < $length) {
                        $string .= $data[random_int(0, 9)];
                    }
                    break;
                case 'nozero':
                    $pool = '123456789';

                    return substr(str_shuffle(str_repeat($pool, ceil($length / strlen($pool)))), 0, $length);
                case 'md5':
                    return md5(uniqid(mt_rand(), true));
                case 'sha1':
                    return sha1(uniqid(mt_rand(), true));
                case 'hex':
                    if (($length % 2) !== 0) {
                        $string = "Length must be even";
                    } else {
                        $bytes  = random_bytes($length / 2);
                        $string = bin2hex($bytes);
                    }
                    break;
                case 'binary':
                    $string = random_bytes($length);
                    break;
                default:
                    $pool   = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $string = substr(str_shuffle(str_repeat($pool, ceil($length / strlen($pool)))), 0, $length);
                    break;
            }

            return $string;
        }

        /**
         * Create a "Random" String
         *
         * @param string    type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
         * @param int    number of characters
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:25
         *
         */
        public static function randomString($type = 'alnum', $len = 8): string
        {
            switch ($type) {
                case 'basic':
                    return mt_rand();
                case 'alnum':
                case 'numeric':
                case 'nozero':
                case 'alpha':
                    switch ($type) {
                        case 'alpha':
                            $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            break;
                        case 'alnum':
                            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            break;
                        case 'numeric':
                            $pool = '0123456789';
                            break;
                        case 'nozero':
                            $pool = '123456789';
                            break;
                        default:
                            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    }

                    return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
                case 'sha1':
                    return sha1(uniqid(mt_rand(), true));
                default:
                    return md5(uniqid(mt_rand(), true));
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
         * @since   0.1.0
         *
         * @param string $string the string to split
         *
         * @return  string[]  an array
         *
         * @throws  BadMethodCallException    if $string is null
         * @throws  InvalidArgumentException  if $string is not a string
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
                    throw new InvalidArgumentException(
                        __METHOD__ . "() expects parameter one to be a string"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . "() expects one parameter, a string"
                );
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
         * @since  0.1.0
         *
         * @param string $haystack the string to search
         * @param string $needle   the substring to search for
         *
         * @return  bool  true if $haystack starts with $needle
         *
         * @throws  BadMethodCallException    if $haystack or $needle is omitted
         * @throws  InvalidArgumentException  if $haystack is not a string
         * @throws  InvalidArgumentException  if $needle is not a string
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
                                $startsWith = !strncmp($haystack, $needle, strlen($needle));
                            } else {
                                $startsWith = false;
                            }
                        } else {
                            $startsWith = false;
                        }
                    } else {
                        throw new InvalidArgumentException(
                            __METHOD__ . " expects the second parameter, the needle, to be a string"
                        );
                    }
                } else {
                    throw new InvalidArgumentException(
                        __METHOD__ . " expects the first parameter, the haystack, to be a string"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . " expects two string parameters, haystack and needle"
                );
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
         * @since   0.1.0
         *
         * @param string $string the string to convert
         *
         * @return  int|float  the number of bytes
         *
         * @throws  BadMethodCallException    if $string is null
         * @throws  InvalidArgumentException  if $string is not a string
         * @throws  InvalidArgumentException  if $string does not end in 'k', 'm', or 'g'
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
                    $val  = trim($string);
                    $last = strtolower($val[strlen($val) - 1]);

                    switch ($last) {

                        case 'm':
                        case 'k':
                        case 'g':
                            $val *= 1024;
                            break;
                        // no break

                        // no break

                        default:
                            throw new InvalidArgumentException(
                                __METHOD__ . " expects the first parameter to end in 'k', 'm', or 'g'"
                            );
                    }
                } else {
                    throw new InvalidArgumentException(
                        __METHOD__ . " expects the first parameter to be a string"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . " expects one parameter"
                );
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
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-27 22:21
         *
         * @param        $value
         * @param string $delimiter
         *
         * @return bool|false|mixed|string|string[]|null
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
         * @since  0.1.0
         *
         * @param string $string the string to camel-case
         *
         * @return  string  the camel-cased string
         *
         * @throws  BadMethodCallException    if $string is empty
         * @throws  InvalidArgumentException  if $string is not a string
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
                        $string = strtolower($string);

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
                    throw new InvalidArgumentException(
                        __METHOD__ . " expects the first parameter, the string, to be a string"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . " expects one parameter, a string to camel-case"
                );
            }

            return $string;
        }

        /**
         * Function reverseCase
         *
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-27 22:19
         *
         * @param $str
         *
         * @return array|int
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
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-27 22:19
         *
         * @param $str
         *
         * @return array|string
         */
        public static function titleCase($str)
        {
            if (!is_array($str)) {
                return ucwords(strtolower($str));
            }
            foreach ($str as $key => $value) {
                $str[$key] = ucwords(strtolower($value));
            }

            return $str;
        }

        /**
         * Function camelizeCase
         *
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-27 22:19
         *
         * @param        $str
         * @param string $encoding
         *
         * @return string|string[]|null
         */
        public static function camelizeCase($str, string $encoding = 'UTF-8')
        {
            $str = str_replace(array('_', '-'), ' ', strtolower(trim($str)));
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
         * @since   0.1.0
         *
         * @param mixed  $string    the string to truncate
         * @param mixed  $limit     the string's max length
         * @param string $break     the break character (to truncate at exact length set to
         *                          empty string or null) (if the break character does not exist in the string,
         *                          the string will be truncated at limit) (optional; if omitted, defaults to ' ')
         * @param string $pad       the padding to add to end of string (optional; if
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
                                if (strlen($string) > $limit) {
                                    // truncate the string at the limit
                                    $truncated = substr($string, 0, $limit);
                                    // if a break character is defined and it exists in the truncated string
                                    if ($break !== null && $break !== '' && strpos($truncated, $break)) {
                                        $truncated = substr($truncated, 0, strrpos($truncated, $break));
                                    }
                                    // if a pad exists, use it
                                    if ($pad !== null && $pad !== '') {
                                        $truncated .= $pad;
                                    }
                                } else {
                                    $truncated = $string;
                                }
                            } else {
                                throw new InvalidArgumentException(
                                    __METHOD__ . "() expects the fourth parameter, pad, to be a string or null"
                                );
                            }
                        } else {
                            throw new InvalidArgumentException(
                                __METHOD__ . "() expects the third parameter, break, to be a string or null"
                            );
                        }
                    } else {
                        throw new InvalidArgumentException(
                            __METHOD__ . "() expects the second parameter, limit, to be an integer"
                        );
                    }
                } else {
                    throw new InvalidArgumentException(
                        __METHOD__ . "() expects the first parameter, the string, to be a string"
                    );
                }
            } else {
                throw new BadMethodCallException(
                    __METHOD__ . "() expects at least two parameters, a string and an integer length limit"
                );
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
                $str = strtolower($str);
            }
            $data = DataRepository::getData('string');
            if (!empty($str)) {
                $str = preg_replace("/[^a-zA-Z0-9]/", $separator, $str);
                $str = preg_replace("/-+/", $separator, $str);
                $str = str_replace(array($data['special_array'], $data['vn_array'], $data['ascii_array'], $data['utf8_array'], ' '), array($separator, $data['en_array'], $data['normal_array'], $data['normal_array'], $separator), $str);
                while (strpos($str, '--') > 0) {
                    $str = str_replace('--', $separator, $str);
                }
                while (strpos($str, '--') === 0) {
                    $str = str_replace('--', $separator, $str);
                }
            }

            return $str;
        }
    }
}
