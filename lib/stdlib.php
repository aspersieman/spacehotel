<?php
/**
 * stdlib.php - Stanard library for the project
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once 'config.php';

/**
 * Register the autoloaded classes
 * @param page $page
 */
function __autoload($class) {
    include "$class.php";
}

/**
 * Create a randomised password from predefined characters
 * @return string
 */
function createRandomPassword() {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

/**
 * Return the base URL for the site
 * @return string
 */
function baseUrl() {
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['HTTP_HOST'],
        $_SERVER['REQUEST_URI']
    );
}
?>
