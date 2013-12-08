<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

session_start();

$site = new csite();
$site->addHeader(LAYOUT_PATH . "basic_header.php");
$site->addFooter(LAYOUT_PATH . "basic_footer.php");

$page = new cpage(basename(__FILE__));
$site->setPage($page);

$errmsg_arr = array();
$errflag = false;
if(empty($_SESSION['captchaCode'] ) ||
    strcmp($_SESSION['captchaCode'], $_POST['captchaCode']) != 0) {
    $errmsg_arr[] = 'Invalid captcha code. Please re-type the captcha code. Note: it is case sensitive.';
    $errflag = true;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: customerdetailsedit.php");
    exit();
}

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
header("location: ../index.php");
?>
