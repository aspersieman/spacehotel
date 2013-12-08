<?php

/**
 * roomselect.php - The user gets to select the room they want to reserve
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

session_start();

$site = new csite();
$site->addHeader(LAYOUT_PATH . "header.php");
$site->addFooter(LAYOUT_PATH . "footer.php");

$page = new cpage(basename(__FILE__));
$site->setPage($page);

$page->bookingArrivalDate = (isset($_POST['bookingArrivalDate'])) ? $_POST['bookingArrivalDate'] : $_SESSION['bookingArrivalDate'];
$_SESSION['bookingArrivalDate'] = $page->bookingArrivalDate;
$page->bookingDepartureDate = (isset($_POST['bookingDepartureDate'])) ? $_POST['bookingDepartureDate'] : $_SESSION['bookingDepartureDate'];
$_SESSION['bookingDepartureDate'] = $page->bookingDepartureDate;
$page->bookingNumberAdults = (isset($_POST['bookingNumberAdults'])) ? $_POST['bookingNumberAdults'] : $_SESSION['bookingNumberAdults'];
$_SESSION['bookingNumberAdults'] = $page->bookingNumberAdults;
$page->bookingNumberChildren = (isset($_POST['bookingNumberChildren'])) ? $_POST['bookingNumberChildren'] : (($_SESSION['bookingNumberChildren']) ? $_SESSION['bookingNumberChildren'] : 0);
$_SESSION['bookingNumberChildren'] = $page->bookingNumberChildren;
$arrivalDate = new DateTime(str_replace("/", "-", $page->bookingArrivalDate));
$departureDate = new DateTime(str_replace("/", "-", $page->bookingDepartureDate));
$page->bookingNumberDays = $departureDate->diff($arrivalDate)->format("%a");
$_SESSION['bookingNumberDays'] = $page->bookingNumberDays;
session_write_close();

// List of rooms to show in content
$page->rooms = R::getAll("SELECT * FROM room");
$page->roomsQuantityReserved = Array();
foreach($page->rooms as $room) {
    $roomId = $room['id'];
    $quantityReserved = R::getRow(
        "SELECT SUM(quantity_reserve) FROM room_inventory WHERE arrival <= ? AND departure >= ? AND id = ?", 
        Array($page->bookingArrivalDate, $page->bookingDepartureDate, $roomId)
    );
    $reserved = $quantityReserved["SUM(quantity_reserve)"];
    $page->roomsQuantityReserved[$roomId] = $reserved;
}
$site->render($page);
?>
