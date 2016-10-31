<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 19/09/2016
 * Time: 13:23
 */
$GLOBALS['config'] = array(

    'mysql'    => array(
        'host'                      => getenv('DB_HOST'),     // database hostname or IP address
        'username'                  => getenv('DB_USERNAME'),          // username
        'password'                  => getenv('DB_PASSWORD'),              // password
        'db'                        => getenv('DB_DB'),          // database name
    ),
    'remember'=>array(
        'cookie_name'=> 'hash',
        'cookie_expiry'=>604800
    ),
    'session'=>array(
        'session_name'=> 'user',
        'token_name'  => 'token'
    ),
    'path' => array(
        'URL'      => 'http://127.0.0.1/ecommerce/public',         // path used for hrefs & css/js location
    ),
    'default' => array(
        'error_page_controller'    => 'error_handler',
        'header_file'              => '../app/views/includes/header.php',
        'navbar_top'              => '../app/views/includes/navtop.php',
        'navbar_side'              => '../app/views/includes/navside.php',
        'footer_file'              => '../app/views/includes/footer.php',
        'foot_file'              => '../app/views/includes/foot.php',
    ),
    'logging' => array(
        'enable'                => true,                    // true for enabled, false for disabled
        'enable_php_errors'     => true,                   // same as in php.ini but using ini_set()
    )
);

