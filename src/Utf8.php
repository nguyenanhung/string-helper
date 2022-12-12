<?php
/**
 * Project string-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/22/2021
 * Time: 18:22
 */

namespace nguyenanhung\Libraries\String;

if (!class_exists('nguyenanhung\Libraries\String\Utf8')) {
    /**
     * Utf8 Class
     *
     * Provides support for UTF-8 environments
     *
     * @package        CodeIgniter
     * @subpackage     Libraries
     * @category       UTF-8
     * @author         EllisLab Dev Team
     * @link           https://codeigniter.com/user_guide/libraries/utf8.html
     */
    class Utf8
    {
        /**
         * Utf8 constructor.
         * Determines if UTF-8 support is to be enabled.
         */
        public function __construct()
        {
            $charset = 'UTF-8';
            if (extension_loaded('mbstring')) {
                define('MB_ENABLED', true);
                // mbstring.internal_encoding is deprecated starting with PHP 5.6
                // and it's usage triggers E_DEPRECATED messages.
                @ini_set('mbstring.internal_encoding', $charset);
                // This is required for mb_convert_encoding() to strip invalid characters.
                // That's utilized by CI_Utf8, but it's also done for consistency with iconv.
                mb_substitute_character('none');
            } else {
                define('MB_ENABLED', false);
            }
            // There's an ICONV_IMPL constant, but the PHP manual says that using
            // iconv's predefined constants is "strongly discouraged".
            if (extension_loaded('iconv')) {
                define('ICONV_ENABLED', true);
                // iconv.internal_encoding is deprecated starting with PHP 5.6
                // and it's usage triggers E_DEPRECATED messages.
                @ini_set('iconv.internal_encoding', $charset);
            } else {
                define('ICONV_ENABLED', false);
            }
            if (defined('PREG_BAD_UTF8_ERROR')                // PCRE must support UTF-8
                && (ICONV_ENABLED === true or MB_ENABLED === true)    // iconv or mbstring must be installed
                && strtoupper($charset) === 'UTF-8'    // Application charset must be UTF-8
            ) {
                define('UTF8_ENABLED', true);
            } else {
                define('UTF8_ENABLED', false);
            }
        }

        // --------------------------------------------------------------------

        /**
         * Clean UTF-8 strings
         *
         * Ensures strings contain only valid UTF-8 characters.
         *
         * @param string $str String to clean
         *
         * @return    string
         */
        public function clean_string(string $str): string
        {
            if ($this->is_ascii($str) === false) {
                if (MB_ENABLED) {
                    $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
                } elseif (ICONV_ENABLED) {
                    $str = iconv('UTF-8', 'UTF-8//IGNORE', $str);
                }
            }

            return $str;
        }

        // --------------------------------------------------------------------

        /**
         * Remove ASCII control characters
         *
         * Removes all ASCII control characters except horizontal tabs,
         * line feeds, and carriage returns, as all others can cause
         * problems in XML.
         *
         * @param string $str String to clean
         *
         * @return    string
         */
        public function safe_ascii_for_xml(string $str): string
        {
            return remove_invisible_characters_string($str, false);
        }

        // --------------------------------------------------------------------

        /**
         * Convert to UTF-8
         *
         * Attempts to convert a string to UTF-8.
         *
         * @param string $str      Input string
         * @param string $encoding Input encoding
         *
         * @return    string    $str encoded in UTF-8 or FALSE on failure
         */
        public function convert_to_utf8(string $str, string $encoding)
        {
            if (MB_ENABLED) {
                return mb_convert_encoding($str, 'UTF-8', $encoding);
            }

            if (ICONV_ENABLED) {
                return @iconv($encoding, 'UTF-8', $str);
            }

            return false;
        }

        // --------------------------------------------------------------------

        /**
         * Is ASCII?
         *
         * Tests if a string is standard 7-bit ASCII or not.
         *
         * @param string $str String to check
         *
         * @return    bool
         */
        public function is_ascii(string $str): bool
        {
            return (preg_match('/[^\x00-\x7F]/S', $str) === 0);
        }
    }
}

