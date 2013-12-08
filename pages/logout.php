<?php
session_start();

//Unset the variables stored in session
unset($_SESSION['user_id']);
unset($_SESSION['user_position']);
session_write_close();
header("location: ../index.php");
?>
