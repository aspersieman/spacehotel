<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

//Start session
session_start();

//Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return mysql_real_escape_string($str);
}

//Sanitize the POST values
$userName = clean($_POST['user']);
$password = clean($_POST['password']);

//Create query
$qry="";
$result=mysql_query($qry);
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
        header("location: admin_index.php");
        exit();
    }else {
        //Login failed
        header("location: admin.php");
        exit();
    }
}else {
    header("location: admin.php");
    exit();
}
?>
