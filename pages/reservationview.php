<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

$site = new csite();
$site->addHeader(LAYOUT_PATH . "basic_header.php");
$site->addFooter(LAYOUT_PATH . "basic_footer.php");

$page = new cpage(basename(__FILE__));
$site->setPage($page);
if (isset($_GET['resid'])){
    $reservationId = $_GET['resid'];
    $page->reservation = R::getRow("SELECT * FROM reservation WHERE id = ?", Array($reservationId));
    $roomId = $page->reservation["room_id"];
    $page->room = R::getRow("SELECT * FROM room WHERE id = ?", Array($roomId));
} else {
   echo 'ERROR: Reservation not found.';
}
$site->render($page);
?>


