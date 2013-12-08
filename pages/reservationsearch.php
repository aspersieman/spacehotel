<?php

/**
 * reservationsearch.php - Get the appropriate parameters from the user to 
 * search for reservations
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

$site = new csite();
$site->addHeader(LAYOUT_PATH . "basic_header.php");
$site->addFooter(LAYOUT_PATH . "basic_footer.php");
$page = new cpage(basename(__FILE__));
$page->rooms = R::getAll("SELECT * FROM room");
$site->setPage($page);
$site->render($page);
?>

