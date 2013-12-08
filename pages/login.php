<?php

/**
 * login.php - Log the user in to the back end
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

session_start();

$userName = $_POST['user'];
$password = $_POST['password'];

// Get the user record
$user = R::getAll(
    "SELECT * FROM user WHERE username=? AND password=?", 
    Array($userName, $password)    
);
//Check whether the query was successful or not
if($user) {
    if(count($user) > 0) {
        $user = $user[0];
        //Login Successful
        session_regenerate_id();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_position'] = $user['role'];
        session_write_close();
        // Go to the admin back end
        header("location: admin_index.php");
        exit();
    }else {
        //Login failed - log the user out (clear the session)
        header("location: logout.php");
        exit();
    }
}else {
    //User doesn't exist - log the user out (clear the session)
    header("location: logout.php");
    exit();
}
?>
