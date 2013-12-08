<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

session_start();

$site = new csite();
$site->addHeader(LAYOUT_PATH . "header.php");
$site->addFooter(LAYOUT_PATH . "footer.php");

$page = new cpage(basename(__FILE__));
$site->setPage($page);

$page->bookingArrivalDate = $_SESSION['bookingArrivalDate'];
$page->bookingDepartureDate = $_SESSION['bookingDepartureDate'];
$page->bookingNumberAdults = $_SESSION['bookingNumberAdults'];
$page->bookingNumberChildren = $_SESSION['bookingNumberChildren'];	
$page->bookingNumberRooms = (isset($_POST['bookingNumberRooms'])) ? $_POST['bookingNumberRooms'] : $_SESSION['bookingNumberRooms'];
$_SESSION['bookingNumberRooms'] = $page->bookingNumberRooms;
$page->bookingRoomId = (isset($_POST['bookingRoomId'])) ? $_POST['bookingRoomId'] : $_SESSION['bookingRoomId'];
$_SESSION['bookingRoomId'] = $page->bookingRoomId;
$page->bookingNumberDays = (isset($_POST['bookingNumberDays'])) ? $_POST['bookingNumberDays'] : $_SESSION['bookingNumberDays'];
$_SESSION['bookingNumberDays'] = $page->bookingNumberDays;

$site->render($page);
?>
