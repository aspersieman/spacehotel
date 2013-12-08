<?php
/**
 * admin_index.php - The main landing page for the back end administration 
 * area
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

$site = new csite(True);
$site->addHeader(LAYOUT_PATH . "header.php");
$site->addFooter(LAYOUT_PATH . "footer.php");

$page = new cpage(basename(__FILE__));
// Set up the varialbles to pass to the view
$page->userPosition = $_SESSION['user_position'];
$page->reservations = R::getAll("SELECT * FROM reservation where status != 'Out'");
$page->rooms = R::getAll("SELECT * FROM room");
$page->roomInventory = R::getAll("SELECT * FROM room_inventory where status != 'Out'");
// If "view" is passed using the query string, set the view variable to
// trigger the correct modal dialog to be displayed in the view
$page->view = (isset($_GET["view"])) ? $_GET["view"] : Null;
$site->setPage($page);
$site->render($page);
?>
