<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

$site = new csite(True);
$site->addHeader(LAYOUT_PATH . "basic_header.php");
$site->addFooter(LAYOUT_PATH . "basic_footer.php");

$page = new cpage(basename(__FILE__));
$roomId = (isset($_GET['id'])) ? $_GET['id'] : 0;
$room = R::getRow("SELECT * FROM room WHERE id = ?", Array($roomId));
$page->room = $room;
$site->setPage($page);
$site->render($page);
?>

