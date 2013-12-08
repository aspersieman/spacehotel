<?php

/**
 * customerdetails.php - Get the personal details from the customer
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

// Start the session to store what the customer has already entered 
// in the session
session_start();

$site = new csite();
$site->addHeader(LAYOUT_PATH . "header.php");
$site->addFooter(LAYOUT_PATH . "footer.php");

$page = new cpage(basename(__FILE__));
$site->setPage($page);

// Store the variables to pass to the view
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
