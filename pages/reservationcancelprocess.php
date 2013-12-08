<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

$site = new csite();
$site->addHeader(LAYOUT_PATH . "basic_header.php");
$site->addFooter(LAYOUT_PATH . "basic_footer.php");
$page = new cpage(basename(__FILE__));
$site->setPage($page);
$confirmationCode = $_POST['confirmation'];
$reservation = R::getRow("SELECT * FROM reservation where confirmation_code = ?", Array($confirmationCode));
$errmsg_arr = array();
if (!$reservation) {
    session_start();
    $errmsg_arr[] = 'Confirmation code not found - please check your confirmation code sent via email.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: ../index.php");
}
R::exec("DELETE FROM reservation WHERE confirmation_code = ?", Array($confirmationCode));
header("location: ../index.php");
exit();
?>
