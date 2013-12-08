<?php

/**
 * roomchange.php - Change the reserved room for a customer
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
$site->setPage($page);
$confirmationCode = $_POST['confirmationCode'];
$reservation = R::getRow("SELECT * FROM reservation where confirmation_code = ?", Array($confirmationCode));
$errmsg_arr = array();
// Check for errors and return to show them to the user
if (!$reservation) {
    session_start();
    $errmsg_arr[] = 'Confirmation code not found - please check your confirmation code sent via email.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: ../index.php");
}
// If no errors set the view variables
$page->arrivalDate = $reservation['arrival_date'];
$page->departureDate = $reservation['departure_date'];
$page->numberAdults = $reservation['number_adults'];
$page->numberChildren = $reservation['number_children'];
$page->numberDays = $reservation['number_days'];
$page->confirmationCode = $reservation['confirmation_code'];
$page->roomId = $reservation['room_id'];
$page->rooms = R::getAll("SELECT * FROM room");
$site->render($page);
?>
