<?php
require_once 'lib/db.php';
require_once 'lib/stdlib.php';

session_start();

$site = new csite();
$site->addHeader(LAYOUT_PATH . "header.php");
$site->addFooter(LAYOUT_PATH . "footer.php");
$page = new cpage(basename(__FILE__));
$page->rooms = R::getAll("SELECT * FROM room");
$site->setPage($page);
$site->render($page);
?>
