<?php
/**
 * Project string-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/22/2021
 * Time: 17:28
 */

namespace nguyenanhung\Libraries\String;

if (!class_exists('nguyenanhung\Libraries\String\DataRepository')) {
    /**
     * Class DataRepository
     *
     * @package   nguyenanhung\Libraries\String
     * @author    713uk13m <dev@nguyenanhung.com>
     * @copyright 713uk13m <dev@nguyenanhung.com>
     */
    class DataRepository
    {
        const CONFIG_PATH = 'config';
        const CONFIG_EXT = '.php';

        /**
         * Hàm lấy nội dung config được quy định trong thư mục config
         *
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/28/18 14:47
         *
         * @param string $configName Tên file config
         *
         * @return array|mixed
         */
        public static function getData($configName)
        {
            $path = __DIR__ . DIRECTORY_SEPARATOR . self::CONFIG_PATH . DIRECTORY_SEPARATOR . trim($configName) . self::CONFIG_EXT;
            if (is_file($path) && file_exists($path)) {
                return require $path;
            }

            return array();
        }
    }
}
