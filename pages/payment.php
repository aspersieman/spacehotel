<?php
require_once '../lib/stdlib.php';
require_once '../lib/db.php';

session_start();

$site = new csite();
$site->addHeader(LAYOUT_PATH . "header.php");
$site->addFooter(LAYOUT_PATH . "footer.php");

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
    header("location: customerdetails.php");
    exit();
}
if (!isset($_POST['Submit'])) {
    $errmsg_arr = array();
    $errflag = false;

    $confirmation = createRandomPassword();
    $page->bookingArrivalDate = $_SESSION['bookingArrivalDate'];
    $page->bookingDepartureDate = $_SESSION['bookingDepartureDate'];
    $page->bookingNumberAdults = $_SESSION['bookingNumberAdults'];
    $page->bookingNumberChildren = $_SESSION['bookingNumberChildren'];	
    $page->bookingNumberRooms = $_SESSION['bookingNumberRooms'];
    $page->bookingRoomId = $_SESSION['bookingRoomId'];
    $page->bookingNumberDays = $_SESSION['bookingNumberDays'];
    $page->customerFirstName = (isset($_POST["customerFirstName"])) ? $_POST["customerFirstName"] : $_SESSION["customerFirstName"];
    $page->customerLastName = (isset($_POST["customerLastName"])) ? $_POST["customerLastName"] : $_SESSION["customerLastName"];
    $page->customerAddress = (isset($_POST["customerAddress"])) ? $_POST["customerAddress"] : $_SESSION["customerAddress"];
    $page->customerCity = (isset($_POST["customerCity"])) ? $_POST["customerCity"] : $_SESSION["customerCity"];
    $page->customerZip = (isset($_POST["customerZip"])) ? $_POST["customerZip"] : $_SESSION["customerZip"];
    $page->customerCountry = (isset($_POST["customerCountry"])) ? $_POST["customerCountry"] : $_SESSION["customerCountry"];
    $page->customerPassword = (isset($_POST["customerPassword"])) ? $_POST["customerPassword"] : $_SESSION["customerPassword"];
    $page->customerEmail = (isset($_POST["customerEmail"])) ? $_POST["customerEmail"] : $_SESSION["customerEmail"];
    $page->customerContactNumber = (isset($_POST["customerContactNumber"])) ? $_POST["customerContactNumber"] : $_SESSION["customerContactNumber"];
    $status= 'Active';
    $roomRow = R::getRow(
        "SELECT * FROM room WHERE id = ?", 
        Array($page->bookingRoomId)
    );
    $rate = (isset($roomRow['rate'])) ? $roomRow['rate'] : 0;
    $page->roomType = (isset($roomRow["type"])) ? $roomRow['type'] : Null;

    $page->amountPayable = $rate * $page->bookingNumberDays * $page->bookingNumberRooms;

    $subject = "Reservation Notification";
    $from = EMAIL_ADDRESS;
    $body = "<h1>This is your reservation notification for your stay at Space Hotel.</h1>";
    $body .= "<strong>First Name:</strong> $page->customerFirstName<br/>".
        "<strong>Last Name:</strong> $page->customerLastName<br/>".
        "<strong>Email:</strong> $page->customerEmail <br/>".
        "<strong>City:</strong> $page->customerCity <br/>".
        "<strong>Zip Code:</strong> $page->customerZip <br/>".
        "<strong>Country:</strong> $page->customerCountry <br/>".
        "<strong>Contact Number:</strong> $page->customerContactNumber <br/>".
        "<strong>Password:</strong> $page->customerPassword <br/>".
        "<strong>Check In:</strong> $page->bookingArrivalDate<br/> ".
        "<strong>Check Out:</strong> $page->bookingDepartureDate<br/> ".
        "<strong>Number of Adults:</strong> $page->bookingNumberAdults<br/> ".
        "<strong>Number of child:</strong> $page->bookingNumberChildren<br/> ".
        "<strong>Total nights of stay:</strong> $page->bookingNumberDays<br/> ".
        "<strong>Room Type:</strong> $page->roomType<br/> ".
        "<strong>Number of rooms:</strong> $page->bookingNumberRooms<br/> ".
        "<strong>Payable amount:</strong> $page->amountPayable<br/> ".
        "<strong>Confirmation Number:</strong> $confirmation<br/> ";	
    $body .= "<br/><br/>Please enjoy your stay.";

    require_once '../lib/PHPMailerAutoload.php';
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = EMAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL_ADDRESS;
    $mail->Password = EMAIL_PASSWORD;
    $mail->SMTPSecure = 'tls';
    $mail->isHTML(true);

    $mail->From = EMAIL_ADDRESS;
    $mail->FromName = 'No Reply';
    $mail->addAddress($page->customerEmail, $page->customerFirstName . " " . $page->customerLastName);
    $mail->addReplyTo(EMAIL_ADDRESS, EMAIL_ADDRESS);
    $mail->WordWrap = 50;

    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = $body;

    if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
       //exit;
    }

    $sqlInsertReservation = "INSERT INTO reservation ( "
    . "       arrival_date, "
    . "       departure_date, "
    . "       number_adults, "
    . "       number_children, "
    . "       number_days, "
    . "       room_id, "
    . "       number_rooms, "
    . "       firstname, "
    . "       lastname, "
    . "       city, "
    . "       zip, "
    . "       address, "
    . "       country, "
    . "       email, "
    . "       username, "
    . "       contact, "
    . "       password, "
    . "       amount_payable, "
    . "       status, "
    . "       confirmation_code  "
    . "       )"
    . "       VALUES ( "
    . "       :arrival, "
    . "       :departure, "
    . "       :number_adults, "
    . "       :number_children, "
    . "       :number_days, "
    . "       :room_id, "
    . "       :number_rooms, "
    . "       :firstname, "
    . "       :lastname, "
    . "       :city, "
    . "       :zip, "
    . "       :address, "
    . "       :country, "
    . "       :email, "
    . "       :username, "
    . "       :contact, "
    . "       :password, "
    . "       :amount_payable, "
    . "       :status, "
    . "       :confirmation_code  "
    . "       )";
    R::exec(
        $sqlInsertReservation,
        Array(
          ":arrival" => $page->bookingArrivalDate,
          ":departure" => $page->bookingDepartureDate,
          ":number_adults" => $page->bookingNumberAdults,
          ":number_children" => $page->bookingNumberChildren,
          ":number_days" => $page->bookingNumberDays,
          ":room_id" => $page->bookingRoomId,
          ":number_rooms" => $page->bookingNumberRooms,
          ":firstname" => $page->customerFirstName,
          ":lastname" => $page->customerLastName,
          ":city" => $page->customerCity,
          ":zip" => $page->customerZip,
          ":address" => $page->customerAddress,
          ":country" => $page->customerCountry,
          ":email" => $page->customerEmail,
          ":username" => $page->customerEmail,
          ":contact" => $page->customerContactNumber,
          ":password" => $page->customerPassword,
          ":amount_payable" => $page->amountPayable,
          ":status" => $status,
          ":confirmation_code" => $confirmation
        )
    );
    R::exec(
        "INSERT INTO room_inventory (arrival_date, departure_date, quantity_reserve, room_id, confirmation_code, status) VALUES (:arrival, :departure, :quantity_reserve, :room_id, :confirmation_code, :status)",
        Array(
           ":arrival" => $page->bookingArrivalDate,
           ":departure" => $page->bookingDepartureDate,
           ":quantity_reserve" => $page->bookingNumberRooms,
           ":room_id" => $page->bookingRoomId,
           ":confirmation_code" => $confirmation,
           ":status" => $status
        )
    );
}
$site->render($page);
?>
