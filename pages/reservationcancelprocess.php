<?php

/**
 * reservationcancelprocess.php - Process the database query to cancel a reservation
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
$confirmationCode = $_POST['confirmation'];
$reservation = R::getRow("SELECT * FROM reservation where confirmation_code = ?", Array($confirmationCode));
// If the confirmation code isn't found, go back to the index page and notify the user
$errmsg_arr = array();
if (!$reservation) {
    session_start();
    $errmsg_arr[] = 'Confirmation code not found - please check your confirmation code sent via email.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: ../index.php");
}
// If the reservation was found, delete it
// TODO: Ensure the customer is logged in before deleting the reservation
R::exec("DELETE FROM reservation WHERE confirmation_code = ?", Array($confirmationCode));
header("location: ../index.php");
exit();
?>
