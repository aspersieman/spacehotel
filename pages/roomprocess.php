<?php
require_once '../lib/db.php';
require_once '../lib/stdlib.php';

$site = new csite(True);

if (isset($_POST['yes'])) {
    $roomId = $_POST['roomid'];
    R::exec("DELETE FROM room WHERE id = ?", Array($roomId));
} elseif (isset($_POST['no'])) {
    header("location: admin_index.php#2");
} elseif (isset($_POST['roomadd'])) {
    $type = $_POST['type'];
    $rate = $_POST['rate'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    R::exec(
        "INSERT INTO room (type, rate, description, quantity) VALUES (:type, :rate, :description, :quantity)",
        Array(
            ":type" => $type,
            ":rate" => $rate,
            ":description" => $description,
            ":quantity" => $quantity
        )
    );
} else {
    $roomId = $_POST['roomid'];
    $roomType = $_POST['roomtype'];
    $roomRate = $_POST['rate'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    R::exec(
        "UPDATE room SET type = :type, rate = :rate, description = :description, quantity = :quantity WHERE id = :roomId",
        Array(
            ":type" => $roomType,
            ":rate" => $roomRate,
            ":description" => $description,
            ":quantity" => $quantity,
            ":roomId" => $roomId
        )
    );
}
header("location: admin_index.php#2");
?> 

