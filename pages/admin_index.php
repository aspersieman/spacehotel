<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

$site = new csite(True);
$site->addHeader(LAYOUT_PATH . "header.php");
$site->addFooter(LAYOUT_PATH . "footer.php");

$page = new cpage(basename(__FILE__));
$page->userPosition = $_SESSION['user_position'];
$page->reservations = R::getAll("SELECT * FROM reservation where status != 'Out'");
$page->rooms = R::getAll("SELECT * FROM room");
$page->roomInventory = R::getAll("SELECT * FROM room_inventory where status != 'Out'");
$page->view = (isset($_GET["view"])) ? $_GET["view"] : Null;
$site->setPage($page);
$site->render($page);
?>
