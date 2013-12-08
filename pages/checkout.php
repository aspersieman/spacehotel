<?php
if (isset($_GET['resid'])) {
    require_once '../lib/db.php';
    require_once '../lib/stdlib.php';

    $site = new csite(True);
    $site->addHeader(LAYOUT_PATH . "basic_header.php");
    $site->addFooter(LAYOUT_PATH . "basic_footer.php");

    $reservationId = $_GET['resid'];
    $reservation = R::getRow("SELECT * FROM reservation where id = ?", Array($reservationId));
    $confirmationCode = $reservation['confirmation_code'];
    R::exec("UPDATE reservation SET status = :status WHERE id = :resid", Array(":status" => 'Out', ":resid" => $reservationId));
    R::exec("UPDATE room_inventory SET status = :status WHERE confirmation_code = :confcode", Array(":status" => 'Out', ":confcode" => $confirmationCode));
    header("location: admin_index.php#1");
}
?>

