<?php

/**
 * config.php - main configuration file used for site
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
define('APP_ROOT', "/spacehotel");
define('BASE_PATH', dirname(realpath(__FILE__)) . '/../');
define('PAGE_PATH', BASE_PATH . 'pages/');
define('VIEW_PATH', BASE_PATH . 'views/');
define('LAYOUT_PATH', BASE_PATH . 'layouts/');
define('LIB_PATH', BASE_PATH . 'lib/');
define('IMG_PATH', APP_ROOT . '/public/img/');
define('DATABASE_NAME', 'spacehotel');
define('DATABASE_USER', 'spacehotel');
define('DATABASE_PASSWORD', 'spacehotel');
define('EMAIL_ADDRESS', 'email@gmail.com');
define('EMAIL_PASSWORD', 'password');
define('EMAIL_HOST', 'smtp.gmail.com');
define('EMAIL_PORT', '465');
setlocale(LC_MONETARY, 'en_ZA');
?>
