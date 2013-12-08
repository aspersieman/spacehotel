<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

$site = new csite();
$site->addHeader(LAYOUT_PATH . "basic_header.php");
$site->addFooter(LAYOUT_PATH . "basic_footer.php");

$page = new cpage(basename(__FILE__));
$site->setPage($page);
$page->arrivalDate = $_POST['arrivalDate'];
$page->departureDate = $_POST['departureDate'];
$page->numberAdults = $_POST['numberAdults'];
$page->numberChildren = $_POST['numberChildren'];	
$page->numberRooms = $_POST['numberRooms'];
$page->roomId = $_POST['roomId'];
$page->confirmationCode = $_POST['confirmationCode'];
$page->reservation = R::getRow("SELECT * FROM reservation WHERE confirmation_code = ?", Array($page->confirmationCode));
$site->render($page);
?>

