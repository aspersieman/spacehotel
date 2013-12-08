<?php

/**
 * reservationsearchresults.php - Show the search results to the user
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

// User needs to be logged in (true passed)
$site = new csite(true);
$site->addHeader(LAYOUT_PATH . "basic_header.php");
$site->addFooter(LAYOUT_PATH . "basic_footer.php");
$page = new cpage(basename(__FILE__));
$customerFirstName = (isset($_POST["customerFirstName"]) && $_POST["customerFirstName"] != "") ? "%" . $_POST["customerFirstName"] . "%" : Null;
$customerLastName = (isset($_POST["customerLastName"]) && $_POST["customerLastName"] != "") ? "%" . $_POST["customerLastName"] . "%" : Null;
$customerEmail = (isset($_POST["customerEmail"]) && $_POST["customerEmail"] != "") ? "%" . $_POST["customerEmail"] . "%" : Null;
$arrivalDate = (isset($_POST["arrivalDate"]) && $_POST["arrivalDate"]) ? $_POST["arrivalDate"] : Null;
$departureDate = (isset($_POST["departureDate"]) && $_POST["departureDate"]) ? $_POST["departureDate"] : Null;
$status = (isset($_POST["cmbStatus"]) && $_POST["cmbStatus"] != "") ? "%" . $_POST["cmbStatus"] . "%" : Null;
$confirmationCode = (isset($_POST["confirmationCode"]) && $_POST["confirmationCode"] != "") ? "%" . $_POST["confirmationCode"] . "%" : Null;
$roomType = (isset($_POST["cmbRoomType"]) && $_POST["cmbRoomType"] != "") ? "%" . $_POST["cmbRoomType"] . "%" : Null;
$sql = "" .
    " SELECT * " .
    " FROM reservation " .
    " WHERE 1 = 1";
$parameters = Array();
// Set only those parameters that have been entered
if ($arrivalDate) {
    $sql .= " AND arrival_date = :arrivalDate ";
    $parameters[":arrivalDate"] = $arrivalDate;
}
if ($confirmationCode) {
    $sql .= " AND confirmation_code = :confirmationCode ";
    $parameters[":confirmationCode"] = $confirmationCode;
}
if ($departureDate) {
    $sql .= " AND departure_date = :departureDate ";
    $parameters[":departureDate"] = $departureDate;
}
if ($customerEmail) {
    $sql .= " AND email LIKE :customerEmail ";
    $parameters[":customerEmail"] = $customerEmail;
}
if ($customerFirstName) {
    $sql .= " AND firstname LIKE :customerFirstName ";
    $parameters[":customerFirstName"] = $customerFirstName;
}
if ($customerLastName) {
    $sql .= " AND lastname LIKE :customerLastName ";
    $parameters[":customerLastName"] = $customerLastName;
}
if ($roomType) {
    $sql .= " AND room_id LIKE :roomId ";
    $parameters[":roomType"] = $roomType;
}
if ($status) {
    $sql .= " AND status LIKE :status ";
    $parameters[":status"] = $status;
}
$page->reservations = R::getAll(
    $sql,
    $parameters
);
$site->setPage($page);
$site->render($page);
?>
