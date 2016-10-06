<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 19/09/2016
 * Time: 13:17
 */
class config {

    public static function get($path = null) {
        if ($path) {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            $sub_config = $config[$path[0]];
            return $sub_config[$path[1]];
        }
        return false;
    }
}