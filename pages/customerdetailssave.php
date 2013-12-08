<?php

/**
 * customerdetailssave.php - Save the details entered by the customer
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

session_start();

$site = new csite();
$site->addHeader(LAYOUT_PATH . "basic_header.php");
$site->addFooter(LAYOUT_PATH . "basic_footer.php");

$page = new cpage(basename(__FILE__));
$site->setPage($page);

// Create an array to store any errors (will be displayed to the user)
$errmsg_arr = array();
$errflag = false;
if(empty($_SESSION['captchaCode'] ) ||
    // If the captcha code wasn't set by the captcha.php code create an error
    strcmp($_SESSION['captchaCode'], $_POST['captchaCode']) != 0) {
    $errmsg_arr[] = 'Invalid captcha code. Please re-type the captcha code. Note: it is case sensitive.';
    $errflag = true;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    // An error occurred, redirect to customer details
    header("location: customerdetailsedit.php");
    exit();
}

// If no errors occurred get the posted variables
// Create a new password for the customer
$confirmationCode = createRandomPassword();
$arrivalDate = $_POST['arrivalDate'];
$departureDate = $_POST['departureDate'];
$numberAdults = $_POST['numberAdults'];
$numberChildren = $_POST['numberChildren'];	
$numberRooms = $_POST['numberRooms'];
$roomId = $_POST['roomId'];
$numberDays = $_POST['numberDays'];
$customerFirstName = $_POST["customerFirstName"];
$customerLastName = $_POST["customerLastName"];
$customerAddress = $_POST["customerAddress"];
$customerCity = $_POST["customerCity"];
$customerZip = $_POST["customerZip"];
$customerCountry = $_POST["customerCountry"];
$customerPassword = $_POST["customerPassword"];
$customerEmail = $_POST["customerEmail"];
$customerContactNumber = $_POST["customerContactNumber"];

$room = R::getRow("SELECT * FROM room WHERE id = ?", Array($roomId));
$amountPayable = $room["rate"] * $numberDays * $numberRooms;

// Update the existing reservation
R::exec(
    "UPDATE reservation SET arrival_date = :arrivalDate, departure_date = :departureDate, number_adults = :numberAdults, number_children = :numberChildren, number_days = :numberDays, room_id = :roomId, number_rooms = :numberRooms, firstname = :customerFirstName, lastname = :customerLastName, city = :customerCity, zip = :customerZip, country = :customerCountry, email = :customerEmail, contact = :customerContactNumber, password = :customerPassword, amount_payable = :amountPayable WHERE confirmation_code = :confirmationCode",
    Array(
        ":arrivalDate" => $arrivalDate,
        ":departureDate" => $departureDate,
        ":numberAdults" => $numberAdults,
        ":numberChildren" => $numberChildren,
        ":numberDays" => $numberDays,
        ":roomId" => $roomId,
        ":numberRooms" => $numberRooms,
        ":customerFirstName" => $customerFirstName,
        ":customerLastName" => $customerLastName,
        ":customerCity" => $customerCity,
        ":customerZip" => $customerZip,
        ":customerCountry" => $customerCountry,
        ":customerEmail" => $customerEmail,
        ":customerContactNumber" => $customerContactNumber,
        ":customerPassword" => $customerPassword,
        ":amountPayable" => $amountPayable,
        ":confirmationCode" => $confirmationCode
    )
);
// Delete and recreate the room_inventory field based on the updated data
R::exec("DELETE FROM room_inventory WHERE confirmation_code = ?", Array($confirmationCode));
R::exec(
    "INSERT INTO room_inventory (arrival_date, departure_date, quantity_reserve, room_id, confirmation_code) VALUES (:arrivalDate, :departureDate, :numberRooms, :roomId, :confirmationCode)",
    Array(
        ":arrivalDate" => $arrivalDate,
        ":departureDate" => $departureDate,
        ":numberRooms" => $numberRooms,
        ":roomId" => $roomId,
        ":confirmationCode" => $confirmationCode
    )
);
// Redirect back to the main page
header("location: ../index.php");
?>
