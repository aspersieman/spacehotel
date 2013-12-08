<?php

/**
 * logout.php - Log a user out
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
session_start();

//Unset the variables stored in session
unset($_SESSION['user_id']);
unset($_SESSION['user_position']);
session_write_close();
header("location: ../index.php");
?>
